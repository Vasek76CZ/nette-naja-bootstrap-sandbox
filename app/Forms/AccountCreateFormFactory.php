<?php

declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;
use App\Models;

final class AccountCreateFormFactory
{

	/** @var FormFactory */
	private $factory;

	/** @var Models\UserModel */
	private $userModel;

	public function __construct
	(
		FormFactory $factory,
		Models\UserModel $userModel
	)
	{
		$this->factory = $factory;
		$this->userModel = $userModel;
	}

	public function create(callable $onSuccess): Form
	{
		$form = new Form;

		$form->addText('iNick', 'Přezdívka:')
			->setRequired('Položka musí být vyplněna!')
			->addRule($form::MAX_LENGTH, 'Položka musí obsahovat maximálně %d znaků!', 20);
		$form->addText('iEmail', 'E-mail:')
			->setRequired('Položka musí být vyplněna!')
			->addRule($form::MAX_LENGTH, 'Položka musí obsahovat maximálně %d znaků!', 50)
			->addRule(Form::EMAIL, 'Zadejte platnou e-mailovou adresu!')
			->addRule(function($control)
			{
				return $this->userModel->checkEmail($control->value);
			}, 'E-mailová adresa již v systému existuje!');
		$form->addSubmit('iCreate', 'Vytvořit účet');

		$form->onValidate[] = function (Form $form, \stdClass $data)
		{
			$presenter = $form->getPresenter();
			if(!empty($form->errors))
			{
				$presenter->redrawControl('accountCreateSnippet');
			}
		};

		$form->onSuccess[] = function (Form $form, \stdClass $data) use ($onSuccess): void
		{
			$onSuccess();
		};

		return $form;
	}

}
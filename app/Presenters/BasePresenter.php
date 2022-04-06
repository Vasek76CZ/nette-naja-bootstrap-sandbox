<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Forms;


abstract class BasePresenter extends Nette\Application\UI\Presenter
{
	use Nette\SmartObject;

	/** @var Forms\AccountCreateFormFactory */
	private $accountCreateFactory;

	public function __construct
	(
		Forms\AccountCreateFormFactory $accountCreateFactory
	)
	{
		$this->accountCreateFactory = $accountCreateFactory;
	}

	protected function startup(): void
	{
		parent::startup();
		$this->session->start();
	}

	public function createComponentAccountCreateForm(): Form
	{
		return $this->accountCreateFactory->create(function (): void
		{
			$this->redirect('this');
		});
	}

}
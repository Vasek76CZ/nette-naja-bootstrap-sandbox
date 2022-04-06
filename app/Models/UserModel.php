<?php

declare(strict_types=1);

namespace App\Models;

use Nette;
use Nette\Utils\Arrays;

final class UserModel
{

	public function checkEmail($email): bool
	{
		$emails = [
			'boban@ctrlrum.cz',
			'pepan@ctrlrum.cz'
		];

		return (Arrays::contains($emails, $email)) ? false : true;
	}

	public function accountCreate($data): bool
	{

		return  true;
	}

}
<?php

namespace App\APIs;

use OpenAI\Laravel\Facades\OpenAI;

//API client used: https://github.com/openai-php/laravel

class OpenAICaller {

	public function getResponse($input) {
		//Ignore error. Facade is created at runtime.
		$result = OpenAI::completions()->create([
			'model' => 'text-davinci-003',
			'prompt' => 'What is the driving experience of the ' . $input . '?',
			'max_tokens' => 200,
		]);

		return $result['choices'][0]['text'];
	}
}
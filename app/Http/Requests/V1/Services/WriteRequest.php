<?php

namespace App\Http\Requests\V1\Services;

use App\Http\Payloads\V1\CreateServicePayload;
use Illuminate\Foundation\Http\FormRequest;

class WriteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'man:2', 'max:255'],
            'url' => ['required', 'url', 'min:11','max:255'],
        ];
    }

    /**
     * @return CreateServicePayload
     */
    public function payload(): CreateServicePayload
    {
        return new CreateServicePayload(
           name: $this->string('name')->toString(),
           url:  $this->string('url')->toString(),
           user: $this->user()->id
        );
    }
}

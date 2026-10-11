<?php

namespace MvpLounge\MeshFactory\Enum;

enum FactoryElementFieldType: string
{
	case TEXT = 'text';
	case EMAIL = 'email';
	case PASSWORD = 'password';
	case HIDDEN = 'hidden';
	case RADIO = 'radio';
	case BUTTON = 'button';
	case SUBMIT = 'submit';
}
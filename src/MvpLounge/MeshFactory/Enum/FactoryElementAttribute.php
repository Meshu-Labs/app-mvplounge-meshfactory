<?php

namespace MvpLounge\MeshFactory\Enum;


require_once __DIR__ . '/../Constants.php';

if (!defined('MVPLOUNGE_MESHFACTORY_BASE_PATH')) {
    throw new \RuntimeException('MVPLOUNGE_MESHFACTORY_BASE_PATH is not defined.');
}

enum FactoryElementAttribute: string
{
	case ID = 'id';
	case HTML_CLASS = 'class';
	case TITLE = 'title';
	case STYLE = 'style';
	case LANG = 'lang';
	case DIR = 'dir';
	case HIDDEN = 'hidden';
	case TABINDEX = 'tabindex';
	case DRAGGABLE = 'draggable';
	case CONTENTEDITABLE = 'contenteditable';
	case SPELLCHECK = 'spellcheck';
	case TRANSLATE = 'translate';
	case ROLE = 'role';
	case ARIA_LABEL = 'aria-label';
	case ARIA_LABELLEDBY = 'aria-labelledby';
	case ARIA_DESCRIBEDBY = 'aria-describedby';
	case NAME = 'name';
	case HREF = 'href';
	case TARGET = 'target';
	case REL = 'rel';
	case ACTION = 'action';
	case METHOD = 'method';
	case ENCTYPE = 'enctype';
	case NOVALIDATE = 'novalidate';
	case AUTOCOMPLETE = 'autocomplete';
	case PLACEHOLDER = 'placeholder';
	case TYPE = 'type';
	case VALUE = 'value';
	case ROWS = 'rows';
	case COLS = 'cols';
	case COLSPAN = 'colspan';
	case ROWSPAN = 'rowspan';
	case SCOPE = 'scope';
	case HEADERS = 'headers';
	case ABBR = 'abbr';
	case SELECTED = 'selected';
	case CHECKED = 'checked';
	case CELLSPACING = 'cellspacing';
	case CELLPADDING = 'cellpadding';
	case BORDER = 'border';
	case ACCESS = 'access';
	case ALT = 'alt';
	case SRC = 'src';
	case FOR = 'for';
	case HREFLANG = 'hreflang';
	case MEDIA = 'media';
	case PING = 'ping';
	case REFERRERPOLICY = 'referrerpolicy';
}

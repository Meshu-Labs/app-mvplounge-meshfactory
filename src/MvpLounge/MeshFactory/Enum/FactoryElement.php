<?php

namespace MvpLounge\MeshFactory\Enum;

enum FactoryElement: string
{
	case P = 'p';
	case H1 = 'h1';
	case H2 = 'h2';
	case H3 = 'h3';
	case H4 = 'h4';
	case H5 = 'h5';
	case H6 = 'h6';
	case HL = 'hl';
	case IMG = 'img';
	case FIELDSET = 'fieldset';
	case INPUT = 'input';
	case SELECT = 'select';
	case OPTION = 'option';
	case TEXTAREA = 'textarea';
	case FORM = 'form';
	case ANCHOR = 'a';
	case DIV = 'div';
	case SPAN = 'span';
	case LABEL = 'label';
	case ASIDE = 'aside';
	case CONTENT = 'content';
	case HEADER = 'header';
	case FIGURE = 'figure';
	case MAIN = 'main';
	case SECTION = 'section';
	case ARTICLE = 'article';
	case FOOTER = 'footer';
	case NAV = 'nav';
	case TABLE_HEADER_CELL = 'th';
	case TABLE_CELL = 'td';
	case TABLE_ROW = 'tr';
	case TABLE = 'table';
	case TABLE_HEAD = 'thead';
	case TABLE_FOOT = 'tfoot';
	case TABLE_BODY = 'tbody';
}

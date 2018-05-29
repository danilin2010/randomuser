<?

namespace Tests\Randomuser\Domain\Helpers;

use Bitrix\Main\Type;

class FactoryConverter extends \Bitrix\Main\Text\Converter
{
    public function encode($text, $textType = "")
    {
        if ($text instanceof Type\DateTime)
            return $text->toString();
        return $text;
    }

    public function decode($text, $textType = "")
    {
        return $text;
    }
}


<?php

declare(strict_types = 1);

namespace Stoa\Query;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

class DateFormat extends FunctionNode
{
    public $dateString = null;
    public $dateFormat = null;

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->dateString = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->dateFormat = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        return 'DATE_FORMAT(' .
            $this->dateString->dispatch($sqlWalker) . ', ' .
            $this->dateFormat->dispatch($sqlWalker) .
        ')';
    }
}

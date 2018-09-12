<?php
/**
 * Created by Marcelo
 */

namespace Mcs\Bravi;


use Mcs\Bravi\Exception\BusinessException;
use Mcs\Bravi\ValueObject\MessagesEnum;

abstract class AbstractMcsBravi
{

    protected function trataExceptioShortCode($erro, $print = TRUE)
    {
        $msgErro = MessagesEnum::ERRO_INESPERADO;

        $classAlert = 'danger';

        if (is_string($erro)) {
            $msgErro = $erro;
        } elseif ($erro instanceof BusinessException) {
            $msgErro = $erro->getMessage();
            $classAlert = 'warning';
        } elseif ($erro instanceof \Exception) {
            $msgErro .= '<br />Por favor informe a mensagem de erro que esta baixo:<br /><code>' . $erro->getMessage() . '</code>';
        }

        $alert = <<<DIV_ALERT
<div class="alert alert-$classAlert alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  $msgErro
</div>
DIV_ALERT;

        if ($print) {
            echo $alert;
        } else {
            return $alert;
        }

    }

}
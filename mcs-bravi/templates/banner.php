<?php
/**
 * Created by Marcelo
 */

$imageUrl    = $context->imageUrl ;
$urlLogin    = $context->urlLogin;
$urlRegister = $context->urlRegister;

?>

<div class="movies-home">
    <div class="row">
        <div class="col-xs-8 text-center">
            <img src="<?php echo $imageUrl; ?>"/>
        </div>
        <div class="col-xs-4 text-center">

            <h3>Encontre aqui seus filmes favoritos.</h3>

            <div style="margin-top: 30px">
                <a class="btn btn-primary btn-sm"
                   href="<?php echo $urlRegister; ?>">
                    Inscreva-se
                </a>
            </div>

            <div style="margin-top: 20px">
                <a class="btn btn-success btn-sm"
                   href="<?php echo $urlLogin; ?>">
                    Entrar
                </a>
            </div>
        </div>
    </div>
</div>

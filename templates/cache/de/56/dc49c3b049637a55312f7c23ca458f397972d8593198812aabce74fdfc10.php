<?php

/* signup-signin-layout.twig */
class __TwigTemplate_de56dc49c3b049637a55312f7c23ca458f397972d8593198812aabce74fdfc10 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'csstop' => array($this, 'block_csstop'),
            'jstop' => array($this, 'block_jstop'),
            'extraHeader' => array($this, 'block_extraHeader'),
            'content' => array($this, 'block_content'),
            'cssbottom' => array($this, 'block_cssbottom'),
            'jsbottom' => array($this, 'block_jsbottom'),
            'extraFooter' => array($this, 'block_extraFooter'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <title>";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["pageTitle"]) ? $context["pageTitle"] : null), "html", null, true);
        echo "</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <!-- Bootstrap core CSS -->
    <link href=\"/assets/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Font Awesome -->
    <link href=\"/assets/css/font-awesome.min.css\" rel=\"stylesheet\">

    <!-- Endless -->
    <link href=\"/assets/css/endless.min.css\" rel=\"stylesheet\">

    <style>
        .text-success{
            color: #FD6B0D;
        }

    </style>
    ";
        // line 25
        $this->displayBlock('csstop', $context, $blocks);
        // line 27
        echo "
    ";
        // line 28
        $this->displayBlock('jstop', $context, $blocks);
        // line 30
        echo "
    ";
        // line 31
        $this->displayBlock('extraHeader', $context, $blocks);
        // line 33
        echo "
</head>

<body>

";
        // line 38
        $this->env->loadTemplate("flash.twig")->display($context);
        // line 39
        echo "
<div class=\"login-wrapper\">
    <div class=\"text-center\">
        <h2 class=\"fadeInUp animation-delay8\" style=\"font-weight:bold\">
            <span class=\"text-success\">RHINO<sup><small style=\"color: #FD6B0D\">&reg</small></sup></span> <span style=\"color:#65CEA7; text-shadow:0 1px #fff\">CMS</span>
        </h2>
    </div>

    ";
        // line 47
        $this->displayBlock('content', $context, $blocks);
        // line 49
        echo "
</div><!-- /login-wrapper -->


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Jquery -->
<script src=\"/assets/js/jquery-1.10.2.min.js\"></script>

<!-- Bootstrap -->
<script src=\"/assets/bootstrap/js/bootstrap.min.js\"></script>

<!-- Modernizr -->
<script src='/assets/js/modernizr.min.js'></script>

<!-- Pace -->
<script src='/assets/js/pace.min.js'></script>

<!-- Popup Overlay -->
<script src='/assets/js/jquery.popupoverlay.min.js'></script>

<!-- Slimscroll -->
<script src='/assets/js/jquery.slimscroll.min.js'></script>

<!-- Cookie -->
<script src='/assets/js/jquery.cookie.min.js'></script>

<!-- Endless -->
<script src=\"/assets/js/endless/endless.js\"></script>

";
        // line 81
        $this->displayBlock('cssbottom', $context, $blocks);
        // line 83
        echo "
";
        // line 84
        $this->displayBlock('jsbottom', $context, $blocks);
        // line 86
        echo "
";
        // line 87
        $this->displayBlock('extraFooter', $context, $blocks);
        // line 89
        echo "
</body>
</html>
";
    }

    // line 25
    public function block_csstop($context, array $blocks = array())
    {
        // line 26
        echo "    ";
    }

    // line 28
    public function block_jstop($context, array $blocks = array())
    {
        // line 29
        echo "    ";
    }

    // line 31
    public function block_extraHeader($context, array $blocks = array())
    {
        // line 32
        echo "    ";
    }

    // line 47
    public function block_content($context, array $blocks = array())
    {
        // line 48
        echo "    ";
    }

    // line 81
    public function block_cssbottom($context, array $blocks = array())
    {
    }

    // line 84
    public function block_jsbottom($context, array $blocks = array())
    {
    }

    // line 87
    public function block_extraFooter($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "signup-signin-layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  179 => 87,  174 => 84,  169 => 81,  165 => 48,  162 => 47,  158 => 32,  155 => 31,  151 => 29,  148 => 28,  144 => 26,  141 => 25,  134 => 89,  132 => 87,  129 => 86,  127 => 84,  124 => 83,  122 => 81,  86 => 47,  76 => 39,  74 => 38,  67 => 33,  65 => 31,  62 => 30,  60 => 28,  57 => 27,  55 => 25,  26 => 1,  91 => 58,  88 => 49,  32 => 5,  29 => 2,);
    }
}

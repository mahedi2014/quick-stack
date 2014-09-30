<?php

/* signin.twig */
class __TwigTemplate_aa44def5ef5ee65072f55edb4b4bb2b59bdba50ff15403925b00d57e1ca9fea3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("signup-signin-layout.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'csstop' => array($this, 'block_csstop'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "signup-signin-layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "

    <div class=\"login-widget animation-delay1\">
        <div class=\"panel panel-default\">
            <div class=\"panel-heading clearfix\">
                <div class=\"pull-left\">
                    <i class=\"fa fa-lock fa-lg\"></i> Sign in
                </div>

                <div class=\"pull-right\">
                    <span style=\"font-size:11px;\">Don't have any account?</span>
                    <a class=\"btn btn-default btn-xs login-link\" href=\"/signup\" style=\"margin-top:-2px;\"><i class=\"fa fa-plus-circle\"></i> Sign up</a>
                </div>
            </div>
            <div class=\"panel-body\">
                <form class=\"form-login\" action=\"/signin\" method=\"post\">
                    <div class=\"form-group\">
                        <label>Email address</label>
                        <input type=\"email\" placeholder=\"Email address\" class=\"form-control input-sm bounceIn animation-delay2\" name=\"email\" required=\"\" >
                    </div>
                    <div class=\"form-group\">
                        <label>Password</label>
                        <input type=\"password\" placeholder=\"Password\" class=\"form-control input-sm bounceIn animation-delay4\" name=\"password\" required=\"\">
                    </div>
                    ";
        // line 40
        echo "
                    <hr/>
                    <div class=\"form-group\">
                        <div class=\"col-lg-offset-2 col-lg-10 controls text-right\">
                            <button type=\"submit\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-sign-in\"></i> Sign in</button>
                        </div>
                    </div><!-- /form-group -->

                </form>
            </div>
        </div><!-- /panel -->
    </div><!-- /login-widget -->


";
    }

    // line 56
    public function block_csstop($context, array $blocks = array())
    {
        // line 57
        echo "
";
    }

    public function getTemplateName()
    {
        return "signin.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 57,  76 => 56,  58 => 40,  32 => 3,  29 => 2,);
    }
}

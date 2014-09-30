<?php

/* signup.twig */
class __TwigTemplate_b8f2f3c0f4cbc546a5db56dad1c8a2ac68c481c5148dd1a086875debbd88ccec extends Twig_Template
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
            <div class=\"panel-heading\">
                <i class=\"fa fa-plus-circle fa-lg\"></i> Sign up
            </div>
            <div class=\"panel-body\">
                <form class=\"form-login\" id=\"signup\" action=\"/signup\" method=\"post\">
                    <div class=\"form-group\">
                        <label>Username</label>
                        <input type=\"text\" placeholder=\"Username\" class=\"form-control input-sm bounceIn animation-delay2\" name=\"username\" required >
                    </div><!-- /form-group -->
                    <div class=\"form-group\">
                        <label>Email Address</label>
                        <input type=\"email\" placeholder=\"Email address\" class=\"form-control input-sm bounceIn animation-delay5\" name=\"email\" required>
                    </div><!-- /form-group -->
                    <div class=\"form-group\">
                        <label>Password</label>
                        <input type=\"password\" placeholder=\"Password\" class=\"form-control input-sm bounceIn animation-delay3\" name=\"password\" required>
                    </div><!-- /form-group -->
                    <div class=\"form-group\">
                        <label>Confirm Password</label>
                        <input type=\"password\" placeholder=\"Confirm password\" class=\"form-control input-sm bounceIn animation-delay4\" name=\"confirm_password\" required>
                    </div><!-- /form-group -->
                    <div class=\"form-group\">
                        <label class=\"label-checkbox\">
                            <input type=\"checkbox\" name=\"agreement\"/>
                            <span class=\"custom-checkbox info bounceIn animation-delay6\"></span>
                            I accept the agreement.
                        </label>
                    </div><!-- /form-group -->

                    <div class=\"seperator\"></div>
                    <div class=\"form-group\">
                        <div class=\"controls\">
                            Already have an account? <a href=\"/signin\" class=\"primary-font login-link\">Sign In</a>
                        </div>
                    </div><!-- /form-group -->

                    <hr/>

                    <div class=\"form-group\">
                        <div class=\"col-lg-offset-2 col-lg-10 controls text-right\">
                            <button type=\"submit\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-plus-circle\"></i> Sign up</button>
                        </div>
                    </div><!-- /form-group -->
                </form>
            </div>
        </div><!-- /panel -->
    </div><!-- /login-widget -->


";
    }

    // line 57
    public function block_csstop($context, array $blocks = array())
    {
        // line 58
        echo "
";
    }

    public function getTemplateName()
    {
        return "signup.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 58,  88 => 57,  32 => 3,  29 => 2,);
    }
}

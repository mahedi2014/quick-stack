<?php

/* flash.twig */
class __TwigTemplate_419b4db275ce0727eb051f53ece488ba0557aac536cbb814a29fbd96cf6c416c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (($this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "error") || $this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "info"))) {
            // line 2
            echo "    <div id=\"alerts\">
        ";
            // line 3
            if ($this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "error")) {
                // line 4
                echo "            <div class=\"alert alert-danger\" style=\"text-align: center; margin: 0px; \">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                ";
                // line 6
                echo $this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "error");
                echo "
            </div>
        ";
            }
            // line 9
            echo "        ";
            if ($this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "info")) {
                // line 10
                echo "            <div class=\"alert alert-info fixed\" style=\"text-align: center; margin: 0px;\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                ";
                // line 12
                echo $this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "info");
                echo "
            </div>
        ";
            }
            // line 15
            echo "    </div>
";
        }
        // line 17
        echo "
";
    }

    public function getTemplateName()
    {
        return "flash.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 17,  49 => 15,  43 => 12,  39 => 10,  36 => 9,  30 => 6,  24 => 3,  21 => 2,  19 => 1,  179 => 87,  174 => 84,  169 => 81,  165 => 48,  162 => 47,  158 => 32,  155 => 31,  151 => 29,  148 => 28,  144 => 26,  141 => 25,  134 => 89,  132 => 87,  129 => 86,  127 => 84,  124 => 83,  122 => 81,  86 => 47,  76 => 39,  74 => 38,  67 => 33,  65 => 31,  62 => 30,  60 => 28,  57 => 27,  55 => 25,  26 => 4,  91 => 58,  88 => 49,  32 => 5,  29 => 2,);
    }
}

<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* profiles/panopoly/modules/contrib/radix_layouts/plugins/layouts/radix_burr_flipped/radix-burr-flipped.html.twig */
class __TwigTemplate_1df59e28d1f77a2cab917327b1e4cea8e16fe73e7569bf16f73df70209c77ddf extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 13];
        $filters = ["escape" => 13];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 12
        echo "
<div class=\"panel-display burr-flipped clearfix ";
        // line 13
        if (($context["classes"] ?? null)) {
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["classes"] ?? null)), "html", null, true);
        }
        if (($context["class"] ?? null)) {
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["class"] ?? null)), "html", null, true);
        }
        echo "\" ";
        if (($context["css_id"] ?? null)) {
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["css_id"] ?? null)), "html", null, true);
        }
        echo ">
  
  <div class=\"container-fluid\">
    <div class=\"row\">
      <div class=\"col-md-8 radix-layouts-content panel-panel\">
        <div class=\"panel-panel-inner\">
          ";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "contentmain", [])), "html", null, true);
        echo "
        </div>
      </div>
      <div class=\"col-md-4 radix-layouts-sidebar panel-panel\">
        <div class=\"panel-panel-inner\">
          ";
        // line 24
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "sidebar", [])), "html", null, true);
        echo "
        </div>
      </div>
    </div>
  
  </div>
</div><!-- /.burr-flipped -->
";
    }

    public function getTemplateName()
    {
        return "profiles/panopoly/modules/contrib/radix_layouts/plugins/layouts/radix_burr_flipped/radix-burr-flipped.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 24,  76 => 19,  58 => 13,  55 => 12,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "profiles/panopoly/modules/contrib/radix_layouts/plugins/layouts/radix_burr_flipped/radix-burr-flipped.html.twig", "/var/www/html/web/profiles/panopoly/modules/contrib/radix_layouts/plugins/layouts/radix_burr_flipped/radix-burr-flipped.html.twig");
    }
}

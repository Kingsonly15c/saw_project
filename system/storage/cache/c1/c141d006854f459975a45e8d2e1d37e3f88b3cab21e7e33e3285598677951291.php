<?php

/* catalog/tshirtecommerce.twig */
class __TwigTemplate_8bfcec00bbaf3d0e5e46feeb7105a5a3cbf82cf56f950677fe474c6bdaab5181 extends Twig_Template
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
        echo (isset($context["header"]) ? $context["header"] : null);
        echo (isset($context["column_left"]) ? $context["column_left"] : null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">     
      <h1>";
        // line 5
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 8
            echo "        <li><a href=\"";
            echo $this->getAttribute($context["breadcrumb"], "href", array(), "array");
            echo "\">";
            echo $this->getAttribute($context["breadcrumb"], "text", array(), "array");
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">   
    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-list\"></i> ";
        // line 16
        echo (isset($context["product_build"]) ? $context["product_build"] : null);
        echo "</h3>
      </div>
      <div class=\"panel-body\" style=\"padding:0;\">
    <iframe width=\"100%\" height=\"750px\"  style=\"border:0;\" id=\"tshirtecommerce-build\" src=\"";
        // line 19
        echo (isset($context["url"]) ? $context["url"] : null);
        echo "\"></iframe>
      </div>
    </div>
  </div>
</div>
<script type=\"text/javascript\">
  function setHeightF(height){
    document.getElementById('tshirtecommerce-build').setAttribute('height', height + 'px');
  }
</script>
";
        // line 29
        echo (isset($context["footer"]) ? $context["footer"] : null);
    }

    public function getTemplateName()
    {
        return "catalog/tshirtecommerce.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 29,  61 => 19,  55 => 16,  47 => 10,  36 => 8,  32 => 7,  27 => 5,  19 => 1,);
    }
}
/* {{ header }}{{ column_left }}*/
/* <div id="content">*/
/*   <div class="page-header">*/
/*     <div class="container-fluid">     */
/*       <h1>{{ heading_title }}</h1>*/
/*       <ul class="breadcrumb">*/
/*         {% for breadcrumb in breadcrumbs %}*/
/*         <li><a href="{{ breadcrumb['href'] }}">{{ breadcrumb['text'] }}</a></li>*/
/*         {% endfor %}*/
/*       </ul>*/
/*     </div>*/
/*   </div>*/
/*   <div class="container-fluid">   */
/*     <div class="panel panel-default">*/
/*       <div class="panel-heading">*/
/*         <h3 class="panel-title"><i class="fa fa-list"></i> {{ product_build }}</h3>*/
/*       </div>*/
/*       <div class="panel-body" style="padding:0;">*/
/*     <iframe width="100%" height="750px"  style="border:0;" id="tshirtecommerce-build" src="{{ url }}"></iframe>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* <script type="text/javascript">*/
/*   function setHeightF(height){*/
/*     document.getElementById('tshirtecommerce-build').setAttribute('height', height + 'px');*/
/*   }*/
/* </script>*/
/* {{ footer }}*/

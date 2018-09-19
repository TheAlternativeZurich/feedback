<?php

/* layout_base.html.twig */
class __TwigTemplate_e01612cac8cdd85536a8f191ac7942424e44224b641cb3542df2d09e02a8c556 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'content' => array($this, 'block_content'),
            'javascript' => array($this, 'block_javascript'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "layout_base.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "layout_base.html.twig"));

        // line 16
        echo "
";
        // line 29
        echo "
";
        // line 46
        echo "
";
        // line 47
        $context["own_macros"] = $this;
        // line 48
        echo "
<!DOCTYPE html>
<html lang=\"";
        // line 50
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 50, $this->source); })()), "request", array()), "locale", array()), "html", null, true);
        echo "\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

    <!-- fav icons -->
    <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("apple-touch-icon.png"), "html", null, true);
        echo "\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("favicon-32x32.png"), "html", null, true);
        echo "\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("favicon-16x16.png"), "html", null, true);
        echo "\">
    <link rel=\"manifest\" href=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("manifest.json"), "html", null, true);
        echo "\">
    <link rel=\"mask-icon\" href=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("safari-pinned-tab.svg"), "html", null, true);
        echo "\" color=\"#496a6a\">
    <meta name=\"theme-color\" content=\"#496a6a\">

    ";
        // line 64
        $context["title"] =         $this->renderBlock("title", $context, $blocks);
        // line 65
        echo "    ";
        $context["description"] =         $this->renderBlock("description", $context, $blocks);
        // line 66
        echo "
    <title>";
        // line 67
        echo twig_escape_filter($this->env, (isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new Twig_Error_Runtime('Variable "title" does not exist.', 67, $this->source); })()), "html", null, true);
        echo "</title>
    ";
        // line 68
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 71
        echo "
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("dist/app.css"), "html", null, true);
        echo "\"/>
    <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 73
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\"/>
    <meta name=\"description\" content=\"";
        // line 74
        echo twig_escape_filter($this->env, (isset($context["description"]) || array_key_exists("description", $context) ? $context["description"] : (function () { throw new Twig_Error_Runtime('Variable "description" does not exist.', 74, $this->source); })()), "html", null, true);
        echo "\">
    <base href=\"/\" target=\"_self\">
</head>
<body>

";
        // line 79
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER")) {
            // line 80
            echo "    <header class=\"header\">
        <nav class=\"navbar navbar-expand-lg navbar-light bg-light\">
            <div class=\"container\">
                <a class=\"navbar-brand\" href=\"";
            // line 83
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index");
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("base.brand", array(), "layout"), "html", null, true);
            echo "</a>
                <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNavDropdown\"
                        aria-controls=\"navbarNavDropdown\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
                <div class=\"collapse navbar-collapse\" id=\"navbarNavDropdown\">
                    <ul class=\"navbar-nav\">
                        ";
            // line 90
            echo $context["own_macros"]->macro_menu_entry($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("index.title", array(), "index"), $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("index"));
            echo "
                        ";
            // line 91
            if (((twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "user", array(), "any", true, true) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 91, $this->source); })()), "user", array()), "administrator", array())) &&  !(is_string($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5 = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 91, $this->source); })()), "request", array()), "requestUri", array())) && is_string($__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a = "/administration") && ('' === $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a || 0 === strpos($__internal_7cd7461123377b8c9c1b6a01f46c7bbd94bd12e59266005df5e93029ddbc0ec5, $__internal_3e28b7f596c58d7729642bcf2acc6efc894803703bf5fa7e74cd8d2aa1f8c68a))))) {
                // line 92
                echo "                            <div class=\"form-inline\">
                                <a class=\"btn btn-sm btn-outline-secondary\" type=\"button\"
                                   href=\"";
                // line 94
                echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("administration");
                echo "\">";
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("index.title", array(), "administration"), "html", null, true);
                echo "</a>
                            </div>
                        ";
            }
            // line 97
            echo "                    </ul>

                    <ul class=\"navbar-nav ml-auto\">
                        ";
            // line 100
            echo $context["own_macros"]->macro_menu_icon_entry("fas fa-user", $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("account"));
            echo "
                        ";
            // line 101
            echo $context["own_macros"]->macro_menu_icon_entry("fas fa-sign-out", $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("login_logout"));
            echo "
                    </ul>
                </div>
            </div>
        </nav>
    </header>
";
        }
        // line 108
        echo "
<div class=\"content-wrapper\">
    ";
        // line 110
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 110, $this->source); })()), "session", array()), "flashbag", array()), "keys", array())) > 0)) {
            // line 111
            echo "        <div class=\"container\">
            <div class=\"row\">
                ";
            // line 113
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 113, $this->source); })()), "session", array()), "flashbag", array()), "all", array()));
            foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
                // line 114
                echo "                    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["messages"]);
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 115
                    echo "                        <div class=\"col-md-12 alert alert-";
                    echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                    echo " alert-dismissible fade show\" role=\"alert\">
                            ";
                    // line 116
                    echo $context["message"];
                    echo "
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 122
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 123
            echo "            </div>
        </div>
    ";
        }
        // line 126
        echo "
    ";
        // line 127
        if (((isset($context["breadcrumbs"]) || array_key_exists("breadcrumbs", $context)) && (twig_length_filter($this->env, (isset($context["breadcrumbs"]) || array_key_exists("breadcrumbs", $context) ? $context["breadcrumbs"] : (function () { throw new Twig_Error_Runtime('Variable "breadcrumbs" does not exist.', 127, $this->source); })())) > 0))) {
            // line 128
            echo "        <div class=\"container\">
            <div class=\"row\">
                <nav aria-label=\"breadcrumb\">
                    <ol class=\"breadcrumb\">
                        ";
            // line 132
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) || array_key_exists("breadcrumbs", $context) ? $context["breadcrumbs"] : (function () { throw new Twig_Error_Runtime('Variable "breadcrumbs" does not exist.', 132, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
                // line 133
                echo "                            ";
                if ((twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "path", array()) != twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 133, $this->source); })()), "request", array()), "pathinfo", array()))) {
                    // line 134
                    echo "                                <li class=\"breadcrumb-item\">
                                    <a href=\"";
                    // line 135
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "path", array()), "html", null, true);
                    echo "\">
                                        ";
                    // line 136
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "name", array()), "html", null, true);
                    echo "
                                    </a>
                                </li>
                            ";
                }
                // line 140
                echo "                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 141
            echo "
                        <li class=\"breadcrumb-item active\" aria-current=\"page\">
                            ";
            // line 143
            echo twig_escape_filter($this->env, (isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new Twig_Error_Runtime('Variable "title" does not exist.', 143, $this->source); })()), "html", null, true);
            echo "
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    ";
        }
        // line 150
        echo "
    ";
        // line 151
        $this->displayBlock('content', $context, $blocks);
        // line 154
        echo "</div>

<script src=\"";
        // line 156
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("dist/app.js"), "html", null, true);
        echo "\"></script>
";
        // line 157
        $this->displayBlock('javascript', $context, $blocks);
        // line 160
        echo "</body>
</html>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 68
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 69
        echo "
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 151
    public function block_content($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 152
        echo "
    ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 157
    public function block_javascript($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascript"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascript"));

        // line 158
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 1
    public function macro_menu_entry($__name__ = null, $__link__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "link" => $__link__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "macro", "menu_entry"));

            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "macro", "menu_entry"));

            // line 2
            echo "    ";
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 2, $this->source); })()), "request", array()), "requestUri", array()) == (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new Twig_Error_Runtime('Variable "link" does not exist.', 2, $this->source); })()))) {
                // line 3
                echo "        <li class=\"nav-item active\">
            <a class=\"nav-link\" href=\"";
                // line 4
                echo twig_escape_filter($this->env, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new Twig_Error_Runtime('Variable "link" does not exist.', 4, $this->source); })()), "html", null, true);
                echo "\">
                ";
                // line 5
                echo twig_escape_filter($this->env, (isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new Twig_Error_Runtime('Variable "name" does not exist.', 5, $this->source); })()), "html", null, true);
                echo "
                <span class=\"sr-only\">(current)</span>
            </a>
        </li>
    ";
            } else {
                // line 10
                echo "        <li class=\"nav-item\">
            <a class=\"nav-link\" href=\"";
                // line 11
                echo twig_escape_filter($this->env, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new Twig_Error_Runtime('Variable "link" does not exist.', 11, $this->source); })()), "html", null, true);
                echo "\">
                ";
                // line 12
                echo twig_escape_filter($this->env, (isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new Twig_Error_Runtime('Variable "name" does not exist.', 12, $this->source); })()), "html", null, true);
                echo "</a>
        </li>
    ";
            }
            
            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

            
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);


            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 17
    public function macro_dropdown_entry($__name__ = null, $__link__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "name" => $__name__,
            "link" => $__link__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "macro", "dropdown_entry"));

            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "macro", "dropdown_entry"));

            // line 18
            echo "    ";
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 18, $this->source); })()), "request", array()), "requestUri", array()) == (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new Twig_Error_Runtime('Variable "link" does not exist.', 18, $this->source); })()))) {
                // line 19
                echo "        <a class=\"dropdown-item active\" href=\"";
                echo twig_escape_filter($this->env, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new Twig_Error_Runtime('Variable "link" does not exist.', 19, $this->source); })()), "html", null, true);
                echo "\">
            ";
                // line 20
                echo twig_escape_filter($this->env, (isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new Twig_Error_Runtime('Variable "name" does not exist.', 20, $this->source); })()), "html", null, true);
                echo "
            <span class=\"sr-only\">(current)</span>
        </a>
    ";
            } else {
                // line 24
                echo "        <a class=\"dropdown-item\" href=\"";
                echo twig_escape_filter($this->env, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new Twig_Error_Runtime('Variable "link" does not exist.', 24, $this->source); })()), "html", null, true);
                echo "\">
            ";
                // line 25
                echo twig_escape_filter($this->env, (isset($context["name"]) || array_key_exists("name", $context) ? $context["name"] : (function () { throw new Twig_Error_Runtime('Variable "name" does not exist.', 25, $this->source); })()), "html", null, true);
                echo "
        </a>
    ";
            }
            
            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

            
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);


            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 30
    public function macro_menu_icon_entry($__icon__ = null, $__link__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "icon" => $__icon__,
            "link" => $__link__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "macro", "menu_icon_entry"));

            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "macro", "menu_icon_entry"));

            // line 31
            echo "    ";
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 31, $this->source); })()), "request", array()), "requestUri", array()) == (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new Twig_Error_Runtime('Variable "link" does not exist.', 31, $this->source); })()))) {
                // line 32
                echo "        <li class=\"nav-item active\">
            <a class=\"nav-link\" href=\"";
                // line 33
                echo twig_escape_filter($this->env, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new Twig_Error_Runtime('Variable "link" does not exist.', 33, $this->source); })()), "html", null, true);
                echo "\">
                <i class=\"";
                // line 34
                echo twig_escape_filter($this->env, (isset($context["icon"]) || array_key_exists("icon", $context) ? $context["icon"] : (function () { throw new Twig_Error_Runtime('Variable "icon" does not exist.', 34, $this->source); })()), "html", null, true);
                echo "\"></i>
                <span class=\"sr-only\">(current)</span>
            </a>
        </li>
    ";
            } else {
                // line 39
                echo "        <li class=\"nav-item\">
            <a class=\"nav-link\" href=\"";
                // line 40
                echo twig_escape_filter($this->env, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new Twig_Error_Runtime('Variable "link" does not exist.', 40, $this->source); })()), "html", null, true);
                echo "\">
                <i class=\"";
                // line 41
                echo twig_escape_filter($this->env, (isset($context["icon"]) || array_key_exists("icon", $context) ? $context["icon"] : (function () { throw new Twig_Error_Runtime('Variable "icon" does not exist.', 41, $this->source); })()), "html", null, true);
                echo "\"></i>
            </a>
        </li>
    ";
            }
            
            $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

            
            $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);


            return ('' === $tmp = ob_get_contents()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "layout_base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  519 => 41,  515 => 40,  512 => 39,  504 => 34,  500 => 33,  497 => 32,  494 => 31,  475 => 30,  456 => 25,  451 => 24,  444 => 20,  439 => 19,  436 => 18,  417 => 17,  398 => 12,  394 => 11,  391 => 10,  383 => 5,  379 => 4,  376 => 3,  373 => 2,  354 => 1,  343 => 158,  334 => 157,  323 => 152,  314 => 151,  303 => 69,  294 => 68,  282 => 160,  280 => 157,  276 => 156,  272 => 154,  270 => 151,  267 => 150,  257 => 143,  253 => 141,  247 => 140,  240 => 136,  236 => 135,  233 => 134,  230 => 133,  226 => 132,  220 => 128,  218 => 127,  215 => 126,  210 => 123,  204 => 122,  192 => 116,  187 => 115,  182 => 114,  178 => 113,  174 => 111,  172 => 110,  168 => 108,  158 => 101,  154 => 100,  149 => 97,  141 => 94,  137 => 92,  135 => 91,  131 => 90,  119 => 83,  114 => 80,  112 => 79,  104 => 74,  100 => 73,  96 => 72,  93 => 71,  91 => 68,  87 => 67,  84 => 66,  81 => 65,  79 => 64,  73 => 61,  69 => 60,  65 => 59,  61 => 58,  57 => 57,  47 => 50,  43 => 48,  41 => 47,  38 => 46,  35 => 29,  32 => 16,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% macro menu_entry(name, link) %}
    {% if app.request.requestUri == link %}
        <li class=\"nav-item active\">
            <a class=\"nav-link\" href=\"{{ link }}\">
                {{ name }}
                <span class=\"sr-only\">(current)</span>
            </a>
        </li>
    {% else %}
        <li class=\"nav-item\">
            <a class=\"nav-link\" href=\"{{ link }}\">
                {{ name }}</a>
        </li>
    {% endif %}
{% endmacro %}

{% macro dropdown_entry(name, link) %}
    {% if app.request.requestUri == link %}
        <a class=\"dropdown-item active\" href=\"{{ link }}\">
            {{ name }}
            <span class=\"sr-only\">(current)</span>
        </a>
    {% else %}
        <a class=\"dropdown-item\" href=\"{{ link }}\">
            {{ name }}
        </a>
    {% endif %}
{% endmacro %}

{% macro menu_icon_entry(icon, link) %}
    {% if app.request.requestUri == link %}
        <li class=\"nav-item active\">
            <a class=\"nav-link\" href=\"{{ link }}\">
                <i class=\"{{ icon }}\"></i>
                <span class=\"sr-only\">(current)</span>
            </a>
        </li>
    {% else %}
        <li class=\"nav-item\">
            <a class=\"nav-link\" href=\"{{ link }}\">
                <i class=\"{{ icon }}\"></i>
            </a>
        </li>
    {% endif %}
{% endmacro %}

{% import _self as own_macros %}

<!DOCTYPE html>
<html lang=\"{{ app.request.locale }}\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

    <!-- fav icons -->
    <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"{{ asset('apple-touch-icon.png') }}\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"{{ asset('favicon-32x32.png') }}\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"{{ asset('favicon-16x16.png') }}\">
    <link rel=\"manifest\" href=\"{{ asset('manifest.json') }}\">
    <link rel=\"mask-icon\" href=\"{{ asset('safari-pinned-tab.svg') }}\" color=\"#496a6a\">
    <meta name=\"theme-color\" content=\"#496a6a\">

    {% set title = block('title')|raw %}
    {% set description = block('description')|raw %}

    <title>{{ title }}</title>
    {% block stylesheets %}

    {% endblock %}

    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('dist/app.css') }}\"/>
    <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\"/>
    <meta name=\"description\" content=\"{{ description }}\">
    <base href=\"/\" target=\"_self\">
</head>
<body>

{% if is_granted('ROLE_USER') %}
    <header class=\"header\">
        <nav class=\"navbar navbar-expand-lg navbar-light bg-light\">
            <div class=\"container\">
                <a class=\"navbar-brand\" href=\"{{ path(\"index\") }}\">{{ \"base.brand\"|trans({}, \"layout\") }}</a>
                <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNavDropdown\"
                        aria-controls=\"navbarNavDropdown\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
                <div class=\"collapse navbar-collapse\" id=\"navbarNavDropdown\">
                    <ul class=\"navbar-nav\">
                        {{ own_macros.menu_entry(\"index.title\"|trans({}, \"index\"), path(\"index\")) }}
                        {% if app.user is defined and app.user.administrator and not (app.request.requestUri starts with \"/administration\") %}
                            <div class=\"form-inline\">
                                <a class=\"btn btn-sm btn-outline-secondary\" type=\"button\"
                                   href=\"{{ path(\"administration\") }}\">{{ \"index.title\"|trans({}, \"administration\") }}</a>
                            </div>
                        {% endif %}
                    </ul>

                    <ul class=\"navbar-nav ml-auto\">
                        {{ own_macros.menu_icon_entry(\"fas fa-user\", path(\"account\")) }}
                        {{ own_macros.menu_icon_entry(\"fas fa-sign-out\", path(\"login_logout\")) }}
                    </ul>
                </div>
            </div>
        </nav>
    </header>
{% endif %}

<div class=\"content-wrapper\">
    {% if app.session.flashbag.keys|length > 0 %}
        <div class=\"container\">
            <div class=\"row\">
                {% for type, messages in app.session.flashbag.all %}
                    {% for message in messages %}
                        <div class=\"col-md-12 alert alert-{{ type }} alert-dismissible fade show\" role=\"alert\">
                            {{ message|raw }}
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                    {% endfor %}
                {% endfor %}
            </div>
        </div>
    {% endif %}

    {% if breadcrumbs is defined and breadcrumbs|length > 0 %}
        <div class=\"container\">
            <div class=\"row\">
                <nav aria-label=\"breadcrumb\">
                    <ol class=\"breadcrumb\">
                        {% for breadcrumb in breadcrumbs %}
                            {% if breadcrumb.path != app.request.pathinfo %}
                                <li class=\"breadcrumb-item\">
                                    <a href=\"{{ breadcrumb.path }}\">
                                        {{ breadcrumb.name }}
                                    </a>
                                </li>
                            {% endif %}
                        {% endfor %}

                        <li class=\"breadcrumb-item active\" aria-current=\"page\">
                            {{ title }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    {% endif %}

    {% block content %}

    {% endblock %}
</div>

<script src=\"{{ asset('dist/app.js') }}\"></script>
{% block javascript %}

{% endblock %}
</body>
</html>
", "layout_base.html.twig", "/home/famoser/Data/Repos/symfony-template/templates/layout_base.html.twig");
    }
}

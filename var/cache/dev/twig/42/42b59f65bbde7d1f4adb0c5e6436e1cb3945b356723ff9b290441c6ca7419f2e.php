<?php

/* administration/frontend_users.html.twig */
class __TwigTemplate_561f212f512c8140d55c15a1d05033eb8dd3798382b25f8c459833f709a009bd extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("single_content_base.html.twig", "administration/frontend_users.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'description' => array($this, 'block_description'),
            'single_content' => array($this, 'block_single_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "single_content_base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "administration/frontend_users.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "administration/frontend_users.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("index.title", array(), "administration_frontend_user"), "html", null, true);
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 4
    public function block_description($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "description"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "description"));

        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("index.description", array(), "administration_frontend_user"), "html", null, true);
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 8
    public function block_single_content($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "single_content"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "single_content"));

        // line 9
        echo "    <p>
        <a class=\"btn btn-secondary\" href=\"";
        // line 10
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("administration_frontend_user_create");
        echo "\">
            ";
        // line 11
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("create.title", array(), "administration_frontend_user"), "html", null, true);
        echo "
        </a>
    </p>
    <table class=\"table table-striped\">
        <thead>
        <tr>
            <th>";
        // line 17
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("full_name", array(), "trait_person"), "html", null, true);
        echo "</th>
            <th>";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("email", array(), "trait_user"), "html", null, true);
        echo "</th>
            <th>";
        // line 19
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("can_login", array(), "trait_user"), "html", null, true);
        echo "</th>
            <th>";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("last_login", array(), "trait_user"), "html", null, true);
        echo "</th>
            <th class=\"minimal-width\"></th>
            <th class=\"minimal-width\"></th>
        </tr>
        </thead>
        <tbody>

        ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["frontend_users"]) || array_key_exists("frontend_users", $context) ? $context["frontend_users"] : (function () { throw new Twig_Error_Runtime('Variable "frontend_users" does not exist.', 27, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["frontend_user"]) {
            // line 28
            echo "            <tr>
                <td>";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["frontend_user"], "fullName", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["frontend_user"], "email", array()), "html", null, true);
            echo "</td>
                <td>
                    ";
            // line 32
            echo twig_escape_filter($this->env, $this->extensions['App\Extension\TwigExtension']->booleanFilter(twig_get_attribute($this->env, $this->source, $context["frontend_user"], "canLogin", array())), "html", null, true);
            echo "
                    <br/>
                    <a href=\"";
            // line 34
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("administration_frontend_user_toggle_can_login", array("frontendUser" => twig_get_attribute($this->env, $this->source, $context["frontend_user"], "id", array()))), "html", null, true);
            echo "\">
                        ";
            // line 35
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("toggle_login_enabled.change", array(), "administration_frontend_user"), "html", null, true);
            echo "
                    </a>
                </td>
                <td>
                    ";
            // line 39
            echo twig_escape_filter($this->env, $this->extensions['App\Extension\TwigExtension']->dateTimeFilter(twig_get_attribute($this->env, $this->source, $context["frontend_user"], "lastLogin", array())), "html", null, true);
            echo "
                </td>
                <td>
                    <a class=\"btn btn-secondary\"
                       href=\"";
            // line 43
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("administration_frontend_user_update", array("frontendUser" => twig_get_attribute($this->env, $this->source, $context["frontend_user"], "id", array()))), "html", null, true);
            echo "\">
                        <i class=\"fal fa-pencil\"></i>
                    </a>
                </td>
                <td>
                    <a class=\"btn btn-secondary\"
                       href=\"";
            // line 49
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("administration_frontend_user_delete", array("frontendUser" => twig_get_attribute($this->env, $this->source, $context["frontend_user"], "id", array()))), "html", null, true);
            echo "\">
                        <i class=\"fal fa-trash\"></i>
                    </a>
                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['frontend_user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "        </tbody>
    </table>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "administration/frontend_users.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  189 => 55,  177 => 49,  168 => 43,  161 => 39,  154 => 35,  150 => 34,  145 => 32,  140 => 30,  136 => 29,  133 => 28,  129 => 27,  119 => 20,  115 => 19,  111 => 18,  107 => 17,  98 => 11,  94 => 10,  91 => 9,  82 => 8,  64 => 4,  46 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"single_content_base.html.twig\" %}

{% block title %}{{ \"index.title\"|trans }}{% endblock %}
{% block description %}{{ \"index.description\"|trans }}{% endblock %}

{% trans_default_domain \"administration_frontend_user\" %}

{% block single_content %}
    <p>
        <a class=\"btn btn-secondary\" href=\"{{ path(\"administration_frontend_user_create\") }}\">
            {{ \"create.title\"|trans }}
        </a>
    </p>
    <table class=\"table table-striped\">
        <thead>
        <tr>
            <th>{{ \"full_name\"|trans({}, \"trait_person\") }}</th>
            <th>{{ \"email\"|trans({}, \"trait_user\") }}</th>
            <th>{{ \"can_login\"|trans({}, \"trait_user\") }}</th>
            <th>{{ \"last_login\"|trans({}, \"trait_user\") }}</th>
            <th class=\"minimal-width\"></th>
            <th class=\"minimal-width\"></th>
        </tr>
        </thead>
        <tbody>

        {% for frontend_user in frontend_users %}
            <tr>
                <td>{{ frontend_user.fullName }}</td>
                <td>{{ frontend_user.email }}</td>
                <td>
                    {{ frontend_user.canLogin|booleanFormat }}
                    <br/>
                    <a href=\"{{ path(\"administration_frontend_user_toggle_can_login\", {\"frontendUser\" : frontend_user.id}) }}\">
                        {{ \"toggle_login_enabled.change\"|trans }}
                    </a>
                </td>
                <td>
                    {{ frontend_user.lastLogin|dateTimeFormat }}
                </td>
                <td>
                    <a class=\"btn btn-secondary\"
                       href=\"{{ path(\"administration_frontend_user_update\", {\"frontendUser\" : frontend_user.id}) }}\">
                        <i class=\"fal fa-pencil\"></i>
                    </a>
                </td>
                <td>
                    <a class=\"btn btn-secondary\"
                       href=\"{{ path(\"administration_frontend_user_delete\", {\"frontendUser\" : frontend_user.id}) }}\">
                        <i class=\"fal fa-trash\"></i>
                    </a>
                </td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% endblock %}", "administration/frontend_users.html.twig", "/home/famoser/Data/Repos/symfony-template/templates/administration/frontend_users.html.twig");
    }
}

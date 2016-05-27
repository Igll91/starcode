{% if controller is defined %}
    <li class="{% if router.getControllerName() == controller %}active{% endif %}">
        {{ link_to(path, title) }}
    </li>
{% else %}
    <li class="{% if router.getControllerName()~'/'~router.getActionName() == path %}active{% endif %}">
        {{ link_to(path, title) }}
    </li>
{% endif %}

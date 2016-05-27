<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to(modelName ~ "/index", trans._("action.back")) }}</li>
            <li class="next">{{ link_to(modelName ~ "/new", trans._("create.link.message")) }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>{{ trans._("action.search.result") }}</h1>
</div>

{{ content() }}

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>{{ trans._('role.name.label') }}</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for Role in page.items %}
                    <tr>
                        <td>{{ Role.getId() }}</td>
                        <td>{{ Role.getName() }}</td>

                        <td>{{ link_to("Role/edit/"~Role.getId(), trans._("btn.edit")) }}</td>
                        {#TODO: sweet alert are you sure?#}
                        <td>
                            {{ link_to("Role/delete/"~Role.getId(), trans._("btn.delete"),
                            'onclick' : 'deleteConfirmationSweetAlert(this);return false;',
                            'data-title' : trans._('role.delete.sweetalert.title'),
                            'data-text' : trans._('role.delete.sweetalert.text'),
                            'data-type' : 'warning') }}
                        </td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ link_to(modelName ~"/search", trans._("action.first")) }}</li>
                <li>{{ link_to(modelName ~"/search?page="~page.before, trans._("action.previous")) }}</li>
                <li>{{ link_to(modelName ~"/search?page="~page.next, trans._("action.next")) }}</li>
                <li>{{ link_to(modelName ~"/search?page="~page.last, trans._("action.last")) }}</li>
            </ul>
        </nav>
    </div>
</div>

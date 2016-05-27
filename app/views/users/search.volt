<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("users/index", trans.t("action.back")) }}</li>
            <li class="next">{{ link_to("users/new", trans.t("create.link.message")) }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>{{ trans.t('users.name.label') }}</th>
                <th>{{ trans.t('users.email.label') }}</th>
                <th>{{ trans.t('users.enabled.label') }}</th>
                <th>{{ trans.t('users.role.label') }}</th>
                <th>{{ trans.t('users.created.label') }}</th>
                <th>{{ trans.t('users.updated.label') }}</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for user in page.items %}
                    <tr>
                        <td>{{ user.getId() }}</td>
                        <td>{{ user.getName() }}</td>
                        <td>{{ user.getEmail() }}</td>
                        <td>{{ user.getEnabled() }}</td>
                        <td>
                            {{ user.role }}
                        </td>
                        <td>{{ user.getCreated() }}</td>
                        <td>{{ user.getUpdated() }}</td>

                        <td>{{ link_to("users/edit/"~user.getId(), trans.t("btn.edit")) }}</td>
                        <td>{{ link_to("authentication/loginAs?username="~user.getEmail(), trans.t("loginas")) }}</td>
                        <td>
                            {{ link_to("users/delete/"~user.getId(), trans.t("btn.delete"),
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
                <li>{{ link_to("users/search", trans.t("action.first")) }}</li>
                <li>{{ link_to("users/search?page="~page.before, trans.t("action.previous")) }}</li>
                <li>{{ link_to("users/search?page="~page.next, trans.t("action.next")) }}</li>
                <li>{{ link_to("users/search?page="~page.last, trans.t("action.last")) }}</li>
            </ul>
        </nav>
    </div>
</div>

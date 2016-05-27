<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="page-header">
            <h1>{{ trans._("login.title") }}</h1>
        </div>

        {{ content() }}

        {% if error is defined %}
            <div class="alert alert-danger">
                {{ error }}
            </div>
        {% endif %}

        <div>
            {{ form('authentication/login') }}
            <fieldset>
                <div class="form-group">
                    <label for="email">{{ trans._("username") }}</label>
                    {{ text_field('email', 'class' : 'form-control', 'required' : 'required') }}
                </div>
                <div class="form-group">
                    <label for="password">{{ trans._("password")  }}</label>
                    {{ password_field('password', 'class' : 'form-control', 'required' : 'required') }}
                </div>

                <input type="hidden" name="{{ security.getTokenKey() }}"
                       value="{{ security.getToken() }}"/>
                <div>
                    {{ submit_button( trans._("login") , 'class' : 'btn btn-success') }}
                </div>
            </fieldset>
            </form>
        </div>

    </div>
</div>

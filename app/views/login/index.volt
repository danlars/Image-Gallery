<div class="row">
    <div class="large-offset-4 large-4 columns">
        {{ form('login/authenticate', 'method': 'post') }}
        <label for="email">Email
            {{ form.render('email') }}
        </label>
        <label for="password">Password
            {{ form.render('password') }}
        </label>
            {{ form.render('csrf', ['value': security.getToken()]) }}
            {{ submit_button("LOGIN", "class": "button radius float-right") }}
        {{ end_form() }}
    </div>
</div>
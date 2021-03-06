@if (auth()->user()->account->hasLimitations())
  <div class="">
    <img src="/img/people/upgrade_account.png">
    <div class="pa3 br bl bb br2 b--black-10 br--bottom">
      <p class="mb3">{{ trans('people.people_list_account_upgrade_title') }}</p>
      <div class="tc">
        <a href="/settings/subscriptions" class="btn btn-secondary">☆ {{ trans('people.people_list_account_upgrade_cta') }}</a>
      </div>
    </div>
  </div>
@endif
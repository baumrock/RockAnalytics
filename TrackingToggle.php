<div class='RAToggle'>
  <div class='RAOptIn'>
    <svg width="20" height="20" viewBox="0 0 24 24" style="display: inline;">
      <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
        <circle cx="12" cy="12" r="9" />
        <path d="m10 10l4 4m0-4l-4 4" />
      </g>
    </svg>
    <a href=#><?= $rockanalytics->textOptIn() ?></a>
  </div>
  <div class='RAOptOut'>
    <svg width="20" height="20" viewBox="0 0 24 24" style="display: inline;">
      <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
        <circle cx="12" cy="12" r="9" />
        <path d="m9 12l2 2l4-4" />
      </g>
    </svg>
    <a href=#><?= $rockanalytics->textOptOut() ?></a>
  </div>
  </a>
</div>
<script>
  var RockAnalytics;
  if (typeof RockAnalytics == 'undefined') {
    let storageName = 'RockAnalyticsTracking';
    RockAnalytics = {
      enabled: function() {
        let enabled = parseInt(localStorage.getItem(storageName));
        return enabled !== 0;
      },

      toggle: function() {
        if (this.enabled()) {
          localStorage.setItem(storageName, 0);
        } else {
          localStorage.setItem(storageName, 1);
        }
        this.update();
      },

      update: function() {
        if (this.enabled()) {
          document.querySelectorAll('.RAOptIn').forEach((el) => {
            el.style.display = 'none';
          });
          document.querySelectorAll('.RAOptOut').forEach((el) => {
            el.style.display = 'block';
          });
        } else {
          document.querySelectorAll('.RAOptIn').forEach((el) => {
            el.style.display = 'block';
          });
          document.querySelectorAll('.RAOptOut').forEach((el) => {
            el.style.display = 'none';
          });
        }
      },
    };

    // listen for clicks on toggle links
    document.addEventListener('click', function(event) {
      if (!event.target.matches('.RAToggle a')) return;
      event.preventDefault();
      RockAnalytics.toggle();
    }, false);
  }
  RockAnalytics.update();
</script>
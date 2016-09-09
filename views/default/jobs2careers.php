<script type="text/javascript">
$(function() {
  var parser = document.createElement('a');
  parser.href = window.location.href;
  var split = parser.pathname.split('/');
  var city = (split.indexOf('cities') > -1 && split[split.indexOf('cities') + 2] !== 'anywhere') ? split[split.indexOf('cities') + 2] : '';
  var category = split.indexOf('categories') > -1 ? split[split.indexOf('categories') + 2] : '';
  var query = split.indexOf('search') > -1 ? split[split.indexOf('search') + 1] : 'junior+developer';
  if (!city) {
    $('#cities li:not(:contains("Anywhere"))').each(function() {
      makeCall(20, $(this).text().toLowerCase().split(' ').join('-'));
    });
  } else {
    makeCall(100, city);
  }
  function makeCall(limit, location) {
    $.ajax('/jobs2careers', {
      data: {
        location: location,
        industry: 'internet|software|e-commerce|it|systems',
        query: [query, category].filter(function(x) { return !!x; }).join('+'),
        limit: limit,
        start: 0,
        sort: 'r'
      },
      success: function(res) {
        var $themeShowcase = $('.theme-showcase');
        var prices = { 'low': 0, 'medium': 1, 'high': 3 };
        // We are paid more for click throughs to "higher priced" listings, but
        // the results aren't as good. So we are just going to order by most relevant
        // function compare(a, b) {
        //   if (prices[a.price] > prices[b.price]) {
        //     return -1;
        //   }
        //   if (prices[a.price] < prices[b.price]) {
        //     return 1;
        //   }
        //   // a must be equal to b
        //   return 0;
        // }
        for (var idx in res.jobs.sort()) {
          var item = '<a class="list-group-item jobs2careers" data-toggle="modal" data-target="#myModal" data-idx="' + idx + '">';
          item +='<h4><div class="row"><div class="col-sm-9"><span class="job-title">' + res.jobs[idx].title + '</span>&nbsp;';
          item +='<span class="job-company">' + res.jobs[idx].company + '</span></div>';
          item +='<div class="col-sm-3"><span class="label label-primary pull-right">Jobs2Careers</span>';
          item += '<span class="label label-default pull-right">' + moment.utc(res.jobs[idx].date).format('DD MMM YYYY') + '</span>';
          item +='<span class="label label-info pull-right">' + res.jobs[idx].city[0].split(',').join(', ') + '</span></div></div></h4></a>';
          $item = $(item);
          if (!category && !city) {
            var industry = res.jobs[idx].industry0.toLowerCase().split(' / ').join('-');
            if ($themeShowcase.find('h3:contains(' + res.jobs[idx].industry0 + ')').length < 1) {
              $('<h3>' + res.jobs[idx].industry0 + '</h3>').insertBefore('#footer');
              $('<div class="list-group jobs2careers" id="' + industry + '"></div>').insertBefore('#footer');
              $('<p class="pull-right jobs2careers"><a href="#top">^ back to top</a></p>').insertBefore('#footer');
              $('<a name="' + industry + '"></a>').insertBefore('#footer');
            }
            $('#' + industry).append($item);
          } else {
            $('.list-group').append($item);
          }
          $item.click(function(e) {
            $('.modal-title').html(res.jobs[$(this).data('idx')].title + '<br />');
            $('.modal-title').append('<small>' + res.jobs[$(this).data('idx')].company + '</small>');
            $('.modal-body').html(res.jobs[$(this).data('idx')].description + '<br /><br />');
            $('.modal-body').append('<a data-toggle="tooltip" data-placement="bottom" title="These descriptions are generated to help speed up your job searching! See Original Posting for instructions to apply.">Why the bad formatting?</a>');
            $('#job-apply').attr('href', res.jobs[$(this).data('idx')].url);
            $('[data-toggle="tooltip"]').tooltip();
          });
        }
      }
    });
  }
});
</script>

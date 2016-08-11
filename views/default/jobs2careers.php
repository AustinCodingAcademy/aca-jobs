<script type="text/javascript" src="http://api.Jobs2Careers.com/api/j2c.js"></script>
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
        for (var idx in res.jobs) {
          var item = '<a class="list-group-item" href="#" onclick="' + res.jobs[idx].onclick + '">';
          item +='<h4><div class="row"><div class="col-sm-9"><span class="job-title">' + res.jobs[idx].title + '</span>&nbsp;';
          item +='<span class="job-company">' + res.jobs[idx].company + '</span></div>';
          item +='<div class="col-sm-3"><span class="label label-default pull-right">' + moment.utc(res.jobs[idx].date).format('DD MMM YYYY') + '</span>';
          item +='<span class="label label-info pull-right">' + res.jobs[idx].city[0] + '</span></div></div></h4></a>';
          $item = $(item);
          if (!category && !city) {
            var industry = res.jobs[idx].industry0.toLowerCase().split(' / ').join('-');
            if ($themeShowcase.find('h3:contains(' + res.jobs[idx].industry0 + ')').length < 1) {
              $('<h3>' + res.jobs[idx].industry0 + '</h3>').insertBefore('#footer');
              $('<div class="list-group" id="' + industry + '"></div>').insertBefore('#footer');
              $('<p class="pull-right"><a href="#top">^ back to top</a></p>').insertBefore('#footer');
              $('<a name="' + industry + '"></a>').insertBefore('#footer');
            }
            $('#' + industry).append($item);
          } else {
            $('.list-group').append($item);
          }
          $item.click(function(e) {
            e.preventDefault();
          });
        }
      }
    });
  }
});
</script>

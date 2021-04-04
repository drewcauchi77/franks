var heritage_pos = 0,
  elem_width = 0,
  position;
$(window).on('load', function () {
  set_heritage_width();
});

$(window).resize(function () {
  set_heritage_width();
});

function set_heritage_width() {
  elem_width = $(window).width() * $(".heritage-year").length;
  var sgl_width = $(".heritage-set").width($(".feat-banner-cont").width());
  var sel_heritage = $(".heritage-set")[heritage_pos];
  var color_set = $(sel_heritage)
    .children(".heritage-year")
    .data("color");
  var milestone_ratio = 1 / ($(".milestone").length - 1);

  //    console.log(timeline_width);

  $(".heritage-year-cont").width(elem_width);
  $(".heritage-year-cont")
    .not($(".top-10-view"))
    .css("opacity", "1");

  $(".feat-banner-cont").css({
    "background-color": color_set
  });

  for (var i = 0; i < $(".milestone").length; i++) {
    var cur = $(".milestone")[i];
    var pos = milestone_ratio * i;
    $(cur).css("left", pos * 100 + "%");
  }

  // update margin-left

  var active_index = parseInt($(".milestone.active").data("iter"), 10);
  $(".heritage-year-cont").css({
    "margin-left": -($(window).width() * active_index)
  });
}

function heritage_animation() {
  var sel_heritage = $(".heritage-set")[heritage_pos];
  var sel_milestone = $(".milestone")[heritage_pos];
  var next_milestone = $(".milestone")[heritage_pos + 1];
  var prev_milestone = $(".milestone")[heritage_pos - 1];
  var color_set = $(sel_heritage)
    .children(".heritage-year")
    .data("color");
  var next_milestone_year = $(next_milestone)
    .children(".milestone-year")
    .text();
  var prev_milestone_year = $(prev_milestone)
    .children(".milestone-year")
    .text();

  $(".heritage-year-cont").addClass("animating");
  $(".milestone").removeClass("active");

  setTimeout(function() {
    $(".nav-year").fadeOut(function() {
      $("#next .nav-year").html(next_milestone_year);
      $("#prev .nav-year").html(prev_milestone_year);
    });

    $(".heritage-year-cont").animate(
      {
        "margin-left": position
      },
      1000,
      function () {
        console.log(position);
        $(sel_milestone).addClass("active");
        $(this).removeClass("animating");
        $(".nav-items").removeClass("disabled");
        $(".nav-year").fadeIn();

        if ($(".heritage-set").length == 10) {
          if (heritage_pos == $(".heritage-set").length - 1) {
            $("#next").addClass("disabled");
          } else if (heritage_pos == 0) {
            $("#prev").addClass("disabled");
          }
        } else {
          if (heritage_pos == $(".heritage-set").length / 2 - 1) {
            $("#next").addClass("disabled");
          } else if (heritage_pos == 0) {
            $("#prev").addClass("disabled");
          }
        }
      }
    );

    $(".feat-banner-cont").css({
      "background-color": color_set
    });
  }, 500);
}

$('.heritage-nav .nav-items,.banner-nav .nav-items').click(function () {
  if (!$(this).hasClass('disabled')) {
    if (!$('.heritage-year-cont').hasClass('animating')) {
      var direction = $(this).attr('id');
      position = parseInt($('.heritage-year-cont').css('margin-left'));

      if (direction == 'next' && -position + $('.heritage-set').width() < elem_width) {
        position -= $('.heritage-set').width();
        heritage_pos++;
        heritage_animation();
      } else if (direction == 'prev' && position < 0) {
        position += $('.heritage-set').width();
        heritage_pos--;
        heritage_animation();
      }
    }
  }
})


$('.milestone').click(function () {
  var iter = $(this).data('iter');
  var run_state = false;
  position = parseInt($('.heritage-year-cont').css('margin-left'));

  if (iter < heritage_pos) {
    position += $('.heritage-set').width() * (heritage_pos - iter);
    run_state = true;
  } else if (iter > heritage_pos) {
    position -= $('.heritage-set').width() * (iter - heritage_pos);
    run_state = true;
  }

  if (run_state) {
    heritage_pos = iter;

    heritage_animation();
    //            console.log(heritage_pos);            
  }
})
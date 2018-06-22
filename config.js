/*
	Developed by : Raka Suryaardi Widjaja
  Copyright (c) 2016 Gurisa.Com All Rights Reserved.
*/

function isEmpty(input) {
  if (input === "" || input === undefined || input === null || input === " ") {
    return true;
  }
}

function redirect(url) {
  location.href = url;
}

function goto_location(where) {
  var page = '';
  var location = '';
  var title = '';
  var image = '';
  switch (where) {
    case "facebook"   : page = "Facebook"; image = theme_uri + "/conf/img/svg/facebook-color.svg"; location = "https://www.facebook.com/GurisaDevs";break;
    case "twitter"    : page = "Twitter"; image = theme_uri + "/conf/img/svg/twitter-color.svg"; location = "https://www.twitter.com/GurisaDevs";break;
    case "googleplus" : page = "Google Plus"; image = theme_uri + "/conf/img/svg/googleplus-color.svg"; location = "https://plus.google.com/+GurisaDevs";break;
    case "youtube"    : page = "Youtube"; image = theme_uri + "/conf/img/svg/youtube-color.svg"; location = "http://www.youtube.com/c/GurisaDevs";break;
    case "github"     : page = "Github"; image = theme_uri + "/conf/img/svg/github-color.svg"; location = "https://github.com/Gurisa";break;
    case "paypal"     : page = "Paypal"; image = theme_uri + "/conf/img/svg/paypal-color.svg"; location = "https://www.paypal.me/gurisa";break;
    default           : page = "Facebook"; image = theme_uri + "/conf/img/gurisa-rounded-logo.png"; location = "https://www.facebook.com/GurisaDevs";break;
  }
  title = "Visit our " + page + " now ?";
  if (page == "Paypal") {
    title = "Donate to our " + page + " now ?";
  }
  swal({
    title: title,
    text: "Do not worry, you're safe with us.",
    showCancelButton: true,
    confirmButtonColor: "#0a58c1",
    confirmButtonText: "Go Now",
    cancelButtonText: "Cancel",
    closeOnConfirm: true,
    imageUrl: image,
    html:true
  },

  function (isConfirm) {
    if (isConfirm) {
      window.open(location);
    }
  });//endfunction
}

$(document).ready(function(){
    $('#facebook').click(function(event){
        goto_location('facebook');
    });
    $('#twitter').click(function(event){
        goto_location('twitter');
    });
    $('#googleplus').click(function(event){
        goto_location('googleplus');
    });
    $('#youtube').click(function(event){
        goto_location('youtube');
    });
    $('#github').click(function(event){
        goto_location('github');
    });
    $('#paypal').click(function(event){
        goto_location('paypal');
    });

    $("#results").hide();
    $(".status-short").hide();

    //declaration of iCheck.js use
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue'
    });

    new Clipboard("#copy-link");//declaration of cliboard.js use
});

function validate_url(url) {
  var result = true;
  var pattern = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
  if (!pattern.test(url)) {
    result = false;
  }
  return result;
}

function check_protocol(url) {
  var result = true;
  var pattern = /^https?:\/\/|^\/\//i;
  if (!pattern.test(url)) {
    result = false;
  }
  return result;
}

function copy_to_clipboard(id){
    swal({
      title: "Congratulations link copied.",
      text: "Now you can share your link to others. <br />Just paste (CTRL + V) your link anywhere, anytime.",
      type: "success",
      showCancelButton: false,
      confirmButtonColor: "#0a58c1",
      confirmButtonText: "OK",
      closeOnConfirm: true,
      html:true
    });
}

function visit_link(link) {
  if (isEmpty(link)) {
    return;
  }
  else {
    swal({
      title: "Visit shorted link now?",
      text: "Link : " + link + " <br />Don't worry, you're safe with us.",
      type: "info",
      showCancelButton: true,
      cancelButtonColor: "#db343e",
      cancelButtonText: "Cancel",
      confirmButtonColor: "#0a58c1",
      confirmButtonText: "Visit",
      closeOnConfirm: true,
      html:true
    },
    function (isConfirm) {
      if (isConfirm) {
        window.open(link);
      }
    });
  }
}

function add_class(id_name, class_name) {
  if (!isEmpty(id_name) && !isEmpty(class_name)) {
    var new_class = document.getElementById(id_name);
    new_class.className += " " + class_name ;
  }
  else {
    return;
  }
}

function remove_class(id_name, class_name) {
  if (!isEmpty(id_name) && !isEmpty(class_name)) {
    var all_class = document.getElementById(id_name).className.split(" ");
    for (i = 0; i < all_class.length; i++) {
      if (all_class[i] == class_name) {
        all_class[i] = "";
      }
    }
    document.getElementById(id_name).className = "";
    for (i = 0; i < all_class.length; i++) {
      document.getElementById(id_name).className += all_class[i] + " ";
    }
    document.getElementById(id_name).className = document.getElementById(id_name).className.replace("  ","");
  }
  else {
    return;
  }
}

function get_radio_value(form, name) {
  var val;
  var radios = form.elements[name];
  for (var i=0, len=radios.length; i<len; i++) {
    if (radios[i].checked ) {
      val = radios[i].value;
      break;
    }
  }
  return val;
}

function show_results(status) {
  if (status == 200) {
    $(document).ready(function() {
      $("#results").slideToggle("slow");
    });
    swal({
      title: "Congratulations we've short all of your links",
      text: "Now you can share your link to others. <br />Just paste (CTRL + V) your link anywhere, anytime.",
      type: "success",
      showCancelButton: false,
      confirmButtonColor: "#0a58c1",
      confirmButtonText: "OK",
      closeOnConfirm: true,
      html:true
    });
  }
  else {
    return;
  }
}

function password_result(status) {
  if (status == 200) {
    swal({
      title: "Congratulations you've confirmed your password link.",
      text: "You can unshort your link now.",
      type: "success",
      showCancelButton: false,
      confirmButtonColor: "#0a58c1",
      confirmButtonText: "OK",
      closeOnConfirm: true,
      html:true
    });
  }
  else {
    return;
  }
}

var short_form = document.getElementById('short');
if (short_form) {
  document.querySelector('#short').addEventListener('submit', function(e) {
    var form = this;
    e.preventDefault();
    var links = document.getElementById('links').value;
    var links_element = $.trim($('#links').val());
    var iCheck = get_radio_value(short_form,'iCheck');
    var password = document.getElementById('password').value;
    if (isEmpty(links) || links_element.length === 0) {
      document.getElementById("links").focus();
      swal({
        title: "Please type your links correctly.",
        text: "Please insert your links, oh by the way, <br />you can short your link up to 10 links at the same time.",
        type: "error",
        showCancelButton: false,
        confirmButtonColor: "#0a58c1",
        confirmButtonText: "OK",
        closeOnConfirm: false,
        html:true
      });
    }
    else {
      var array_links = $('#links').val().split('\n');
      var invalid_link = false;
      var text_messages = "";
      for (i = 0; i < array_links.length; i++) {
        if (isEmpty(array_links[i])) {
          array_links.splice(i,1);
          i--;
        }
      }
      for (i = 0; i < array_links.length; i++) {
        if (!validate_url(array_links[i]) || isEmpty(array_links[i])) {
          i = array_links.length + 1;
          invalid_link = true;
        }
      }
      if (array_links.length <= 10 && invalid_link === false && !isEmpty(iCheck)) {
        swal({
          title: "Are you sure want to short " + array_links.length + " of your links?",
          text: "The shorting process could take some time. <br />Do not refresh or close this page until the shorting process is done.",
          type: "info",
          showCancelButton: true,
          cancelButtonColor: "#db343e",
          cancelButtonText: "Cancel",
          confirmButtonColor: "#0a58c1",
          confirmButtonText: "Continue",
          closeOnConfirm: true,
          html:true
        },
        function (isConfirm) {
          if (isConfirm) {
            //form.submit();
            add_class('short-button','disabled');
            document.getElementById("links").disabled = true;
            document.getElementById("short-button").disabled = true;
            document.getElementById("public").disabled = true;
            document.getElementById("private").disabled = true;
            document.getElementById("password").disabled = true;
            $(".status-short").show();
            $("#results").hide();
            var xhttp;
            if (window.XMLHttpRequest) {
                xhttp = new XMLHttpRequest();
                } else {
                // old browser like IE5, IE6
                xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xhttp.open("POST","short-url.php",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xhttp.send("links=" + links + "&iCheck=" + iCheck + "&password=" + password);
            xhttp.onreadystatechange = display_data;
            function display_data() {
              if (xhttp.readyState == 4) {
                if (xhttp.status == 200) {
                  show_results(xhttp.status);
                  document.getElementById("results").innerHTML = xhttp.responseText;
                  remove_class("short-button","disabled");
                  document.getElementById("links").disabled = false;
                  document.getElementById("short-button").disabled = false;
                  document.getElementById("public").disabled = false;
                  document.getElementById("private").disabled = false;
                  document.getElementById("password").disabled = false;
                  $(".status-short").hide();
                }
                else {
                  swal({
                    title: "Oops something happened.",
                    text: "Sorry we failed to short your links, please try again.",
                    type: "info",
                    showCancelButton: false,
                    confirmButtonColor: "#0a58c1",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                  remove_class("short-button","disabled");
                  document.getElementById("short-button").disabled = false;
                  $(".status-short").hide();
                }
              }
            }

          }
        });

      }
      else {
        if (array_links.length > 10) {
          text_messages = "Unfortunately we only allowed to short 10 links at the same time.";
        }
        else if (invalid_link) {
          text_messages = "Make sure you type your links correctly.<br />You can include the protocol or port of your links, <br /> for example : <b><b style='color:green';>https://</b>www.gurisa.com<b style='color:orange';>:80</b></b>";
        }
        else if (isEmpty(iCheck)) {
          text_messages = "Please choose your links privacy, the default is Public.";
        }
        swal({
          title: "Oops something happened.",
          text: text_messages,
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#0a58c1",
          confirmButtonText: "OK",
          closeOnConfirm: false,
          html:true
        });
      }
    }
  });
}

var short_content = document.getElementById('short-content');
if (short_content) {
  $(document).ready(function(){
    $("#short-content").hide();
  });
}

var confirm_button = document.getElementById('confirm-button');
var confirm_password = document.getElementById('confirm-password');
var short_password_form = document.getElementById('short-password');
if (short_password_form && confirm_button && confirm_password) {
  document.querySelector('#short-password').addEventListener('submit', function(e) {
    var form = this;
    e.preventDefault();
    if (isEmpty(confirm_password.value)) {
      document.getElementById('confirm-password').focus();
      swal({
        title: "Please type your password correctly.",
        text: "Please insert your password correctly.",
        type: "error",
        showCancelButton: false,
        confirmButtonColor: "#0a58c1",
        confirmButtonText: "OK",
        closeOnConfirm: false,
        html:true
      });
    }
    else {
      swal({
        title: "Confirm your password?",
        text: "You can unshort your link if you type your password correctly.",
        type: "info",
        showCancelButton: true,
        cancelButtonColor: "#db343e",
        cancelButtonText: "Cancel",
        confirmButtonColor: "#0a58c1",
        confirmButtonText: "Continue",
        closeOnConfirm: true,
        html:true
      },
      function (isConfirm) {
        if (isConfirm) {
          form.submit();
          var counter = 0;
          var interval = setInterval(function() {
            counter++;
            swal({
              title: "Working Now.",
              text: "Please wait a while, we match your password link now.",
              type: "warning",
              showConfirmButton: false,
              closeOnConfirm: false,
              timer: 10000,
              html:true
            });
            if (counter == 5) {
              clearInterval(interval);
            }
          }, 1000);
        }
      });
    }
  });
}

var go_short_links = document.getElementById('go-short-links');
if (go_short_links) {
  document.querySelector('#go-short-links').addEventListener('click', function(e) {
    var form = this;
    e.preventDefault();
    swal({
      title: "Short More Links Now?",
      text: "You can easily short up to 10 links at the same time just by one mouse click.",
      type: "info",
      showCancelButton: true,
      cancelButtonText: "Cancel",
      confirmButtonColor: "#0a58c1",
      confirmButtonText: "Short Now",
      closeOnConfirm: true,
      html:true
    },
    function (isConfirm) {
      if (isConfirm) {
        redirect(theme_uri);
      }
    });
  });
}

function show_unshort_link(link) {
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  }
  else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  var result = true;
  xhttp.open("GET","unshort-url.php?v=" + link,true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send();
  xhttp.onreadystatechange = display_data;
  function display_data() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      if (isEmpty(xhttp.responseText)) {
        result = false;
      }
      else {
        short_url = xhttp.responseText;
      }
    }
    else {
      result = false;
    }
  }
  return result;
}

var short_url = "";
var unshort_button = document.getElementById('unshort-button');
if (unshort_button) {
  $(document).ready(function(){
    $("#unshort-button").show();
    $("#visit-button").hide();
  });
  document.querySelector('#unshort-button').addEventListener('click', function(e) {
    var form = this;
    e.preventDefault();
    swal({
      title: "Unshort your link now?",
      text: "Link : " + theme_uri + short_id + "<br /> You can visit your original link after unshorting this link",
      type: "info",
      showCancelButton: true,
      cancelButtonText: "Cancel",
      confirmButtonColor: "#0a58c1",
      confirmButtonText: "Unshort",
      closeOnConfirm: false,
      html:true
    },
    function (isConfirm) {
      if (isConfirm) {
        if (show_unshort_link(short_id)) {
          var counter = 0;
          var interval = setInterval(function() {
            counter++;
            swal({
              title: "Working Now.",
              text: "Please wait a while, we unshorting your link now.",
              type: "warning",
              showConfirmButton: false,
              closeOnConfirm: false,
              timer: 10000,
              html:true
            });
            if (counter == 5) {
              swal({
                title: "We've unshorting your link",
                text: "Hit the Visit button to visit your link.",
                type: "success",
                showConfirmButton: true,
                showCancelButton: false,
                confirmButtonColor: "#0a58c1",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                timer: 10000,
                html:true
              });
              $("#unshort-button").hide();
              $("#visit-button").show();
              clearInterval(interval);
            }
          }, 2000);
        }
        else {
          swal({
            title: "Oops something happened.",
            text: "Sorry we failed to unshort your link, please try again.",
            type: "info",
            showCancelButton: false,
            confirmButtonColor: "#0a58c1",
            confirmButtonText: "OK",
            closeOnConfirm: true,
            html:true
          });
        }
      }
    });
  });
}

var visit_button = document.getElementById('visit-button');
if (visit_button) {
  document.querySelector('#visit-button').addEventListener('click', function(e) {
    var form = this;
    e.preventDefault();
    if (!isEmpty(short_url)) {
      swal({
        title: "Visit link now?",
        text: "Be carefull of phising, spham, and virus sites.",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancel",
        confirmButtonColor: "#0a58c1",
        confirmButtonText: "Visit Now",
        closeOnConfirm: true,
        html:true
      },
      function (isConfirm) {
        if (isConfirm) {
          window.open(short_url);
        }
      });
    }
    else {
      swal({
        title: "Oops something happened.",
        text: "Sorry we can't fetch your request, please try reload the page and try again.",
        type: "info",
        showCancelButton: false,
        confirmButtonColor: "#0a58c1",
        confirmButtonText: "OK",
        closeOnConfirm: true,
        html:true
      });
    }
  });
}

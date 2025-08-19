<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $title ?></title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="/Assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="/Assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["/Assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>
    <script type="text/javascript">
      function getkey(e){
        if (window.event)
        return window.event.keyCode;
        else if (e)
        return e.which;
        else
        return null;
      }

      function goodchars(e, goods, field){
        var key, keychar;
        key = getkey(e);
        if (key == null) return true;
        
        keychar = String.fromCharCode(key);
        keychar = keychar.toLowerCase();
        goods = goods.toLowerCase();

        // check goodkeys
        if (goods.indexOf(keychar) != -1)
        return true;
        // control keys
        if ( key==null || key==0 || key==8 || key==9 || key==27 )
        return true;

        if (key == 13) {
          var i;
          for (i = 0; i < field.form.elements.length; i++)
          if (field == field.form.elements[i])
          break;
          i = (i + 1) % field.form.elements.length;
          field.form.elements[i].focus();
          return false;
        };
        // else return false
        return false;
      }
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/Assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Assets/css/plugins.min.css" />
    <link rel="stylesheet" href="/Assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <!-- <link rel="stylesheet" href="/Assets/css/demo.css" /> -->

    <!-- Custom CSS -->
     <style>
      .hasil-sembunyi {
            display: none;
      }
      .detail-hasil p, .detail-hasil h4 {
          display: flex;
          justify-content: space-between;
          margin-bottom: 0.75rem;
      }
      .detail-hasil h4 {
          margin-top: 1rem;
      }
      .disclaimer {
          font-size: 12px;
          color: #777;
          margin-top: 15px;
          font-style: italic;
          text-align: center;
      }
     </style>
  </head>
<body>
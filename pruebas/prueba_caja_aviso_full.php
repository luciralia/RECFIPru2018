 <!DOCTYPE html>
  <html lang="en">
    <head>
      <script type="text/javascript" src="http://www.google-analytics.com/ga.js"></script>
      <script type="text/javascript">
  window.entity_params = window.entity_params || [];
  window.entity_params['auto_download'] = '1' || undefined;
  window.entity_params['auto_download_time'] = '6' || undefined;
  window.entity_params['download_popup'] = '1' || undefined;
  window.entity_params['lp_exit_confirmation'] = 'no' || undefined;
  window.entity_params['lp_slug'] = '' || undefined;
  window.entity_params['track_page_view'] = 'nlp_generic' || undefined;
</script>
      <script type="text/javascript">
  // &lt;![CDATA[
  window.i18n = {"Your download will start in":"Your download will start in","Please Wait...":"Please Wait...","Seconds":"Seconds","Skip Ad":"Skip Ad"};
  // ]]&gt;
</script>
      <title>Video Player</title>
      <meta name="description" content="Video Player is an intuitive free Video player for playing FLV videos and movies from across the web">
      <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
      <script type="text/javascript" src="/js/libs/jquery.min.js"></script>
      <meta charset="utf-8">
      <script type="text/javascript">
      $(function(){
        setTimeout(function(){
          $("#loading_bar").css("visibility","hidden");
          $("#btn").css("visibility","visible");
          $("#cont_text").html("YOUR DOWNLOAD IS READY");
        },2000)
      });
    </script>
      <style type="text/css">
      html{
        height: 100%;
      }
      body{
        margin:0;
        padding:0;
        background:url(/images/lp/generic/bg.jpg);
        position:relative;
        height: 100%;
      }
      #top_line{
        background:url(/images/lp/generic/top_line.jpg);
        height:31px;
        width:100%;
      }
      #top_shadow{
        background:url(/images/lp/generic/shadow.png) repeat-x;
        height:299px;
      }
      #main_cont{
        position:absolute;
        z-index:2;
        width:100%;
        padding:40px 0 0 0;
      }
      #cont{
        width:648px;
        height:331px;
        margin:auto auto;
        background:url(/images/lp/generic/bg_cont.png) no-repeat;
      }
      #cont_text{
        font-family: 'Play', sans-serif;
        font-weight:700;
        color:#454545;
        text-transform:uppercase;
        text-align:center;
        font-size:24px;
        padding:17px 0 0 0;
        margin:0 0 40px 0;
       }
       #changing_items{
         width:284px;
         margin:auto auto;
       }
      #loading_bar{
        position:absolute;
        width:284px;
        height:30px;
        background:url(/images/lp/generic/loading.gif) no-repeat;
        text-decoration:none;
      }
      #btn{
        position:absolute;
        background:url(/images/lp/generic/btn.png) no-repeat;
        width:285px;
        height:63px;
        visibility:hidden;
        text-decoration:none;
      }
      #btn:hover{
        background-position: 0 -63px;
      }
      #softwareName{
        display: none;
      }
      .file_name_container {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 20px;
        color: #242424;
        text-align: center;
        padding-top: 55px;
      }
    </style>
      <link rel="stylesheet" href="/css/downloadIndicator.css" type="text/css">
      <script type="text/javascript">
      window._gaq = window._gaq || [];
window._gaq.push(['_setAccount', 'UA-31676879-1']);
window._gaq.push(['_setAllowLinker', true]);
window._gaq.push(['_setDomainName', 'none']);
window._gaq.push(['_setCustomVar', 1, 'product', 'flvplayer', 3]);
window._gaq.push(['_trackPageview', window.entity_params['track_page_view'] || 'nlp_']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();      window.nlp = true;
      window.download_url = "http://download.softiglu.com/nlp/j/smb/flvplayer/dl?p1=downloadlink&amp;p3=1&amp;datetime=20131024_1811&amp;utm_source=smb&amp;utm_medium=affiliate&amp;utm_campaign=downloadlink&amp;translate=en&amp;tracking_percent=100&amp;timestamp=1382638299";
      window.a_download = ("1");
      window.icon_url = ("http://download.filesfrog.com/software_files/flvplayer/flvplayer.png");
    </script>
      <script type="text/javascript" src="/js/common.js"></script>
      <script type="text/javascript" src="/js/networkCommon.js"></script>
    </head>
    <body>
      <link rel="stylesheet" href="/css/loadingBarGreen.css" type="text/css">
      <link rel="stylesheet" href="/css/generalPopup.css" type="text/css">
      <div class="general-popup-overlay"></div>
      <div class="general-popup downloadProcessPopup">
        <div class="general-popup-body">Your download is being processed</div>
        <br>
        <div class="loadingBar">
          <span></span>
        </div>
      </div>
      <div id="overlay" style="display: block;"></div>
      <div id="indicationChrome" class="downloadIndicator">
        <div class="chromeIndicationColumn" id="chromeIndicationLeftColumn">
          <h2>Step One</h2>
          <h3>Click the file below</h3>
        </div>
        <div class="chromeIndicationColumn" id="chromeIndicationRightColumn">
          <h2>Step two</h2>
          <h3>Click "Run"</h3>
        </div>
        <div id="filename"></div>
      </div>
      <div id="indicationIe" class="downloadIndicator">
        <div class="indicationIeColumn" id="indicationIeLeftColumn">
          <h2>Step One</h2>
          <h3>Click "Run" Below</h3>
        </div>
        <div class="indicationIeColumn" id="indicationIeRightColumn">
          <h2>Step Two</h2>
          <h3>Click "Yes" when it appears</h3>
        </div>
      </div>
      <div id="indicationFireFox" class="downloadIndicator">
        <table height="100%" width="100%">
          <tbody>
            <tr>
              <td valign="middle">
                <div id="steps-container">
                  <table id="steps">
                    <tbody>
                      <tr>
                        <td>
                          <div class="screenshot">
                            <img alt="Run installer" src="/images/ff_step1.png">
                          </div>
                          <h2>1. Save the application</h2>
                          <p>
                            Click 
                            <strong>Save File</strong>
                             when prompted.
                          </p>
                        </td>
                        <td class="middle">
                          <div class="screenshot">
                            <img alt="Drag the icon to your Applications folder" src="/images/ff_step2.png">
                          </div>
                          <h2>2. Open the Program installer</h2>
                          <p>From your browser's Downloads window, double click the .exe file that just downloaded.</p>
                        </td>
                        <td>
                          <div class="screenshot">
                            <img alt="Double-click the icon" src="/images/ff_step3.png">
                          </div>
                          <h2>3. Follow setup instructions</h2>
                          <p>Follow the instructions to get the Program set up on your computer and you will be good to go!</p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <style type="text/css">
  #downloadPopup {
    background:url(/images/download_popup/bg.gif) no-repeat;
    width:439px;
    height:241px;
    position: absolute;
    display: none;
    z-index: 9999;
    cursor: default;
  }
  #downloadPopup div {
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
    user-select: none;
  }

  .header_pop {
    text-align: left;
    font-family:Arial, Helvetica, sans-serif;
    font-size:12px;
    padding:0 8px 8px;
    overflow:hidden;
  }
  .title_pop{
    padding-top:5px;
    color: #000;
  }
  .exit_pop{
    background:url(/images/download_popup/x.gif) no-repeat;
    width:42px;
    height:18px;
    float:right;
  }
  .content_pop{
  }
  .header_content_pop{
    margin:0 8px 0 8px;
    padding:10px 0 0 20px;
    height:40px;
    border-bottom:1px solid #d2d2d2;
    overflow:hidden;
  }
  .name_logo_pop{
    width:32px;
    height:32px;
    background-repeat: no-repeat;
    background-size: contain;
    float:left;
  }
  .name_text_pop{
    font-family:Arial, Helvetica, sans-serif;
    font-size:19px;
    font-weight: bold;
    padding-top:8px;
    padding-left:5px;
    float:left;
    color: #000;
  }
  .download_ready_pop{
    font-family:Arial, Helvetica, sans-serif;
    font-size:17px;
    color:#38537e;
    padding:15px 0 10px 35px;
    text-align: left;
  }
  .download_btn_pop{
    height:45px;
    background:#f0f1f3;
    margin:0 8px 0 8px;
    padding:5px 0 0 25px;
    overflow:hidden;
    cursor: pointer;
  }
  .download_icon_pop{
    background:url(/images/download_popup/icon.gif) no-repeat;
    width:38px;
    height:38px;
    float:left;
  }
  .download_text_pop{
    font-family:Arial, Helvetica, sans-serif;
    font-size:15px;
    color:#5c5c5d;
    padding:10px 0 0 10px;
    float:left;
  }
  .download_text_pop a{
    color:#5c5c5d;
  }
  .footer_pop{
    font-family:Arial, Helvetica, sans-serif;
    font-size:11px;
    color:#474747;
    margin:20px 8px 0 8px;
    border-top:1px solid #d2d2d2;
    padding:5px 0 0 30px;
    line-height:12px;
    text-align: left;
  }
</style>
      <div id="downloadPopup" style="display: block; position: absolute; top: 222.5px; left: 580.5px;">
        <div class="header_pop">
          <div class="exit_pop"> </div>
          <div class="title_pop">Video Player</div>
        </div>
        <div class="content_pop">
          <div class="header_content_pop">
            <div class="name_logo_pop" style="background-image: url(&quot;http://download.filesfrog.com/software_files/flvplayer/flvplayer.png&quot;);"> </div>
            <div class="name_text_pop">Video Player</div>
          </div>
          <div class="download_ready_pop">Your download is ready!</div>
          <div class="download_btn_pop">
            <div class="download_icon_pop"> </div>
            <div class="download_text_pop">
              <u>Click here to start downloading</u>
            </div>
          </div>
          <div class="footer_pop">
            
      This download is accelerated by the filesfrog downloader utilizing
            <br>
            a worldwide cdn and opening multiple download channels.    
          </div>
        </div>
      </div>
      <div id="softwareName">
        Video Player
        <p id="preparing"></p>
      </div>
      <div id="main_cont">
        <div id="cont">
          <div class="file_name_container" id="filename"> </div>
          <div id="cont_text">YOUR DOWNLOAD IS READY</div>
          <div id="changing_items">
            <a id="loading_bar" style="visibility: hidden;"> </a>
            <a href="#" class="download" id="downloadLink">
              <div id="btn" style="visibility: visible;"></div>
            </a>
          </div>
        </div>
      </div>
      <div id="top_line"> </div>
      <div id="top_shadow"> </div>
    </body>
  </html>
/**
 * Created by User on 5/23/14.
 */
if (!String.prototype.startsWith) {
    String.prototype.startsWith = function (str) {
        return this.indexOf(str) === 0;
    };
}

String.prototype.replaceAll = function(search, replace) {
        var reg = new RegExp(search, "g");
        return this.replace(reg, replace)
};

(function($){

    $.fn.loader = function(show) {
        var tag = this;
        if(show === false) {
            tag.find(".div-mask").detach();
        } else {
            var maskHtml = '<div><span class="vertical-aligner"></span><span class="loader"></span></div>';
            maskHtml = $(maskHtml);
            var position = tag.position();
            var positionType = tag.css("position");
            maskHtml.css({
                position: "absolute",
                left: positionType == "static" ? position.left : 0,
                top: positionType == "static" ? position.top : 0,
                width: maskHtml.width(tag.outerWidth()),
                height: maskHtml.height(tag.outerHeight())
            }).addClass("div-mask");
            tag.append(maskHtml);
        }
    };

    $.fn.paginator = function() {
        this.each(function() {
            var tag = $(this);
            tag.find("li").on("click", function() {
                var $this = $(this);
                if($this.is(".active,.disabled")) {
                    return;
                }
                var max =  parseInt(tag.attr("max"));
                var offset = parseInt(tag.attr("offset"));
                var total = parseInt(tag.attr("total"));
                var activePage = parseInt(tag.find(".active").attr("page"));
                var page = $this.attr("page")
                if(page == "next") {
                    page = activePage + 1;
                } else if (page == "prev") {
                    page = activePage - 1;
                } else {
                    page = parseInt(page)
                }
                tag.attr("offset", (page-1) * max);
                tag.trigger("paginator-click");
            })
        })

    };

    $.fn.config = function(type, updates) {
        var cacheKey = "attr-parsed-cache#" + type;
        var map = this.data(cacheKey)
        if(!map) {
            map = {}
            this.data(cacheKey, map)
            var cutLength = type.length + 1
            $.each(this[0].attributes, function() {
                if(this.name.startsWith(type + "-")) {
                    map[this.name.substring(cutLength)] = util.autoType(this.value);
                }
            })
        }
        if(updates) {
            if(typeof updates == "string") {
                return map[updates]
            } else {
                var obj = $(this);
                $.each(updates, function(k, v) {
                    map[k] = v
                    obj.attr(type + "-" + k, v)
                })
                return this;
            }
        }
        return map;
    }

    $.fn.srFileInput = function() {
        this.each(function(i,elem){
            var $elem = $(elem);
            if (typeof $elem.attr('data-bfi-disabled') != 'undefined') {
                return;
            }
            var buttonWord = 'Browse';

            if (typeof $elem.attr('title') != 'undefined') {
                buttonWord = $elem.attr('title');
            }

            var className = '';

            if (!!$elem.attr('class')) {
                className = ' ' + $elem.attr('class');
            }
            $elem.wrap('<a class="file-input-wrapper btn btn-default ' + className + '"></a>').parent().prepend($('<span></span>').html(buttonWord));
        })
            .promise().done( function(){

                $('.file-input-wrapper').mousemove(function(cursor) {

                    var input, wrapper,
                        wrapperX, wrapperY,
                        inputWidth, inputHeight,
                        cursorX, cursorY;

                    wrapper = $(this);
                    input = wrapper.find("input");
                    wrapperX = wrapper.offset().left;
                    wrapperY = wrapper.offset().top;
                    inputWidth= input.width();
                    inputHeight= input.height();
                    cursorX = cursor.pageX;
                    cursorY = cursor.pageY;
                    moveInputX = cursorX - wrapperX - inputWidth + 20;
                    moveInputY = cursorY- wrapperY - (inputHeight/2);
                    input.css({
                        left:moveInputX,
                        top:moveInputY
                    });
                });

                $('body').on('change', '.file-input-wrapper input[type=file]', function(){

                    var fileName;
                    fileName = $(this).val();
                    $(this).parent().next('.file-input-name').remove();
                    if (!!$(this).prop('files') && $(this).prop('files').length > 1) {
                        fileName = $(this)[0].files.length+' files';
                    }
                    else {
                        fileName = fileName.substring(fileName.lastIndexOf('\\') + 1, fileName.length);
                    }
                    if (!fileName) {
                        return;
                    }

                    var selectedFileNamePlacement = $(this).data('filename-placement');
                    if (selectedFileNamePlacement === 'inside') {
                        $(this).siblings('span').html(fileName);
                        $(this).attr('title', fileName);
                    } else {
                        // Print the fileName aside (right after the the button)
                        $(this).parent().after('<span class="file-input-name">'+fileName+'</span>');
                    }
                });

            });

    };
    var cssHtml = '<style>'+
        '.file-input-wrapper { overflow: hidden; position: relative; cursor: pointer; z-index: 1; }'+
        '.file-input-wrapper input[type=file], .file-input-wrapper input[type=file]:focus, .file-input-wrapper input[type=file]:hover { position: absolute; top: 0; left: 0; cursor: pointer; opacity: 0; filter: alpha(opacity=0); z-index: 99; outline: 0; }'+
        '.file-input-name { margin-left: 8px; }'+
        '</style>';
    $('link[rel=stylesheet]').eq(0).before(cssHtml);

    $.fn.updateUi = function() {
        this.find("input.date-picker").datepicker();
    }

}(jQuery))


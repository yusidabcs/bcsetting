<style>
    .jsThumbnailImageWrapper figure {
        position: relative;
        display: inline-block;
        margin-right: 20px;
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid #eee;
        padding: 3px;
        border-radius: 3px;
    }
    .jsThumbnailImageWrapper i.removeIcon {
        position: absolute;
        top:-10px;
        right:-10px;
        color: #f56954;
        font-size: 2em;
        background: white;
        border-radius: 20px;
        height: 25px;
    }
</style>
<script>
    if (typeof window.openMediaWindowSingle === 'undefined') {
        window.mediaZone = '';
        window.openMediaWindowSingle = function (event, zone) {
            window.single = true;
            window.mediaZone = zone;
            window.zoneWrapper = $(event.currentTarget).siblings('.jsThumbnailImageWrapper');
            window.open('{!! route('media.grid.select') !!}', '_blank', 'menubar=no,status=no,toolbar=no,scrollbars=yes,height=500,width=1000');
        };
    }
    if (typeof window.includeMediaSingle === 'undefined') {
        window.includeMediaSingle = function (mediaId, filePath) {
            var html = '<figure data-id="'+ mediaId +'"><img src="' + filePath + '" alt=""/>' +
                    '<a class="jsRemoveSimpleLink" href="#" data-id="' + mediaId + '">' +
                    '<i class="fa fa-times-circle removeIcon"></i></a>' +
                    '<input type="hidden" name="'+ window.mediaZone +'" value="' + filePath.replace("_mediumThumb",'') + '">' +
                    '</figure>';
            window.zoneWrapper.append(html).fadeIn('slow', function() {
                toggleButton($(this));
            });
        };
    }
</script>
<div class="form-group">
    {!! Form::label($settingName, $moduleInfo['description']) !!}
    <div class="clearfix"></div>

    <a class="btn btn-primary btn-browse" onclick="openMediaWindowSingle(event, '{{ $settingName  }}');" <?php echo (isset($dbSettings[$settingName])) ?'style="display:none;"':'' ?>><i class="fa fa-upload"></i>
        {{ trans('media::media.Browse') }}
    </a>

    <div class="clearfix"></div>

    <div class="jsThumbnailImageWrapper jsSingleThumbnailWrapper">

        <?php if (isset($dbSettings[$settingName])): ?>

            <figure >
                <img src="{{ $dbSettings[$settingName]->plainValue }}" />

                <a class="jsRemoveSimpleLink" href="#" >
                    <i class="fa fa-times-circle removeIcon"></i>
                </a>
            </figure>
            {!! Form::input('hidden', $settingName, Input::old($settingName, $dbSettings[$settingName]->plainValue), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description']),'min' => 0]) !!}
        <?php else: ?>
            {!! Form::input('hidden', $settingName, Input::old($settingName, $dbSettings[$settingName]->plainValue), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description']),'min' => 0]) !!}

        <?php endif; ?>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $('.jsThumbnailImageWrapper').off('click', '.jsRemoveSimpleLink');
        $('.jsThumbnailImageWrapper').on('click', '.jsRemoveSimpleLink', function (e) {
            e.preventDefault();
            $(e.delegateTarget).fadeOut('slow', function() {
                toggleButton($(this));
            }).html('');
        });
    });

    function toggleButton(el) {
        var browseButton = el.parent().find('.btn-browse');
        browseButton.toggle();
    }
</script>



//  * coding for dropdown handler


$('#dropdown--handler').on('click', function (evt) {
    evt.stopPropagation();
    let single = evt.currentTarget.getElementsByTagName("ul")[0];
    single.classList.toggle("hidden");
});

// coding for sidbar menu show
$('#show--menu-bar').on('click', function (evt) {
    evt.stopPropagation();
    $('#sidebar-menu').removeClass('-right-64');
    $('#sidebar-menu').addClass('right-0');
    $(this).hide();
    $('#show--menu-times').show();
});
$('#show--menu-times').on('click', function (evt) {
    evt.stopPropagation();
    $('#sidebar-menu').removeClass('right-0');
    $('#sidebar-menu').addClass('-right-64');
    $(this).hide();
    $('#show--menu-bar').show();
});
$('#sidebar-menu').on('click', function (evt) {
    evt.stopPropagation();
});

$('body,html').on('click', function (e) {
    var container = $("#menu--handler");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.addClass('hidden');
    }
    $('#sidebar-menu').removeClass('right-0');
    $('#sidebar-menu').addClass('-right-64');
    $('#show--menu-bar').show();
    $('#show--menu-times').hide();
});

/**
 *
 * Profile photo uploaded
 */
 $(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function(){
        readURL(this);
    });

    $('#search').on('keyup', function(){
        let value = $(this).val();
        var url = $(this).data('remote');
        $.ajax({
            url:url ,
            type: 'GET',
            dataType: 'json',
            data: {value}
        }).done(function (res) {
            let result = $('.result');
            result.empty();
            if(res.success === true){
                let li = '';
                res.data.forEach(function(val){
                    li += `<li class="py-2 px-3 border-b last:border-b-0 hover:bg-gray-100 transition-all duration-200">
                        <a href="${res.url}/project/${val.slug}" class="flex">
                            <img class="w-8 h-8 object-cover rounded" src="${val.photo}" alt="project-image"/>
                            <p class="pl-2">${val.name}</p>
                        </a>
                    </li>`;
                })
                $('<ul class="absolute left-0 top-0 bg-white shadow w-full"></ul>').html(li).appendTo(result)
            }else if(res.empty === true){
                result.empty();
            }else{
                $('<ul class="absolute left-0 top-0 bg-white shadow w-full"></ul>').html('<li class="px-2 py-2">Data not found!</li>').appendTo(result)
            }
        });
    });
});


var errMess = function (input_type, alert) {
    let wrapper = $("form .form-group input[id='" + input_type + "']")
    if (!$("form>.form-group").find(".alert-padding").length) {
        $(wrapper).after($("<div class=\"alert-padding\"><div class=\"alert alert-danger\" role=\"alert\">" + alert + "</div></div>"))
    }
    else {
        $("form>.form-group").find(".alert-padding").remove()
    }
}

var errMessDateTime = function (alert) {
    let wrapper = $("form .form-group .date")
    if (!$("form>.form-group").find(".alert-padding").length) {
        $(wrapper).after($("<div class=\"alert-padding\"><div class=\"alert alert-danger\" role=\"alert\">" + alert + "</div></div>"))
    }
    else {
        $("form>.form-group").find(".alert-padding").remove()
    }
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    }
    else {
        return true;
    }
}

function logout() {
    $('li#submit_logout').on('click', function (e) {
        e.preventDefault()
        alert('cs')
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/logout",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                window.location.href = "/home"
            }
        })
    })
}

function getNumberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

$(document).ready(function () {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/get-product-category",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === 'success') {
                let data = ''
                $.each(response.data, function (i, item) {
                    data += '<li><a href=\"/product-category/' + item.id + '\">' + item.name + '</li></a>'
                })

                $('li#loaihoa>ul').append(data)
            }
            else {
                console.log(response.data)
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText)
        }
    })
})

function getProductCategory() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/get-product-category",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === 'success') {
                let data = ''
                $.each(response.data, function (i, item) {
                    data += '<option value="' + item.id + '">' + item.name + '</option>'
                })

                $('select#product_category').append(data)
            }
            else {
                console.log(response.data)
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText)
        }
    })
}

function getProvince() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/get-province",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === 'success') {
                let data = ''
                $.each(response.data, function (i, item) {
                    data += '<option value="' + item.id + '">' + item.name + '</option>'
                })

                $('select#province').append(data)
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText)
        }
    })
}

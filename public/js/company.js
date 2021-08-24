//Datatable
$("#companyTable")
    .DataTable({
        responsive: true,
        lengthChange: false,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        buttons: ["copy", "csv", "excel", "pdf", "print"],
    })
    .buttons()
    .container()
    .appendTo("#companyTable_wrapper .col-md-6:eq(0)");

$("#addCompany").validate({
    rules: {
        name: {
            required: true,
        },
        email: {
            required: true,
            email: true,
        },
    },

    messages: {
        name: { required: "Please enter your full name." },
        email: {
            required: "Please enter your email.",
            email: "Please enter a valid email.",
        },
    },

    submitHandler: (form) => {
        const formData = new FormData(form);
        const id = parseInt($("#company_id").val());
        const url = id > 0 ? "/company/" + id : "/company";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "json",
            enctype: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: (responseData) => {
                console.log(responseData);
                if (responseData.response_code == 200) {
                    $("#company-modal").modal("hide");
                    toastr.success(responseData.response_message);
                    window.location.reload();
                } else {
                    toastr.error(responseData.response_message);
                }
            },
            error: (xhr, status, error) => {
                console.log(xhr);
                let error_message = "";
                if (error.status == 422) {
                    error_message = error.responseJSON.errors.email[0];
                } else {
                    error_message = error.responseJSON.response_message;
                }
                toastr.error(error_message);
            },
        });
    },
});

const showCompany = (id) => {
    const request = $.ajax({
        url: "/company/" + id,
        type: "GET",
        dataType: "json",
    });

    request.done((data) => {
        console.log(data);
        if (data.response_code == 200) {
            $("#company_id").val(data.response_data.id);
            $("#name").val(data.response_data.name);
            $("#email").val(data.response_data.email);
            $("#website").val(data.response_data.website);
            $("#show-logo").attr("src", data.response_data.companyLogo);
            $("#company-modal").modal("show");
        } else {
            toastr.error("Sorry! An error occured.");
        }
    });
};

const deleteCompany = (company_id) => {
    const post_data = {
        _token: $("input[name=_token]").val(),
        id: company_id,
    };

    if (confirm("Are you sure you want to delete this company?")) {
        $.ajax({
            url: "/company/" + company_id,
            type: "DELETE",
            data: post_data,
            dataType: "json",
            success: (response) => {
                if (response.response_code == 200) {
                    location.href = "/company";
                    toastr.success(response.response_message);
                } else {
                    location.href = "/company";
                    toastr.error(response.response_message);
                }
            },
            error: (xhr, status, error) => {
                const message = xhr.responseJSON.errors.email[0];
                toastr.error(message);
            },
        });
    }
};

$("#load_photo").on("click", (e) => {
    $("#logo-file").click();
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#show-logo").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#logo-file").on("change", function () {
    readURL(this);
    // fasterPreview(this);
});

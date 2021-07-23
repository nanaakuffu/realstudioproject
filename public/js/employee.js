//Datatable
$("#employeeTable")
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
    .appendTo("#employeeTable_wrapper .col-md-6:eq(0)");

$("#addEmployee").validate({
    rules: {
        first_name: {
            required: true,
        },

        last_name: {
            required: true,
        },

        email: {
            required: true,
            email: true,
        },

        company: {
            required: true,
        },
    },

    messages: {
        first_name: { required: "Please enter your first name." },
        last_name: { required: "Please enter your last name." },
        email: {
            required: "Please enter your email.",
            email: "Please enter a valid email.",
        },
        company: {
            required: "Please select a company to belong",
        },
    },

    submitHandler: (form) => {
        const formData = new FormData(form);
        const id = parseInt($("#employee_id").val());
        const url = id > 0 ? "/employee/" + id : "/employee";

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
                    $("#employee-modal").modal("hide");
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

const showEmployee = (id) => {
    const request = $.ajax({
        url: "/employee/" + id,
        type: "GET",
        dataType: "json",
    });

    request.done((data) => {
        console.log(data);
        if (data.response_code == 200) {
            $("#employee_id").val(data.response_data.id);
            $("#first_name").val(data.response_data.first_name);
            $("#last_name").val(data.response_data.first_name);
            $("#email").val(data.response_data.email);
            $("#phone").val(data.response_data.phone);
            $("#show-picture").attr("src", data.response_data.employeePicture);
            $("#employee-modal").modal("show");
        } else {
            toastr.error("Sorry! An error occured.");
        }
    });
};

const deleteCompany = (employee_id) => {
    const post_data = {
        _token: $("input[name=_token]").val(),
        id: employee_id,
    };

    if (confirm("Are you sure you want to delete this employee?")) {
        $.ajax({
            url: "/company/" + employee_id,
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
    $("#picture-file").click();
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#show-picture").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#picture-file").on("change", function () {
    readURL(this);
});

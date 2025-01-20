function getSessionHTML(rv) {
    let x = `<option value=-1>SELECT ONE</option>`;
    for (let i = 0; i < rv.length; i++) {
        let cs = rv[i];
        x += `<option value=${cs['id']}>${cs['year']} ${cs['term']}</option>`;
    }
    return x;
}

function loadSessions() {
    $.ajax({
        url: "ajaxhandler/attendanceAJAX.php",
        type: "POST",
        dataType: "json",
        data: { action: "getSession" },
        success: function (rv) {
            let x = getSessionHTML(rv);
            $("#ddlclass").html(x);
        },
        error: function () {
            alert("OOPS!");
        }
    });
}

function getCourseCardHTML(classlist) {
    let x = "";
    for (let i = 0; i < classlist.length; i++) {
        let cc = classlist[i];
        x += `<div class="classcard" data-classobject='${JSON.stringify(cc)}'>${cc['code']}</div>`;
    }
    return x;
}

function fetchFacultyCourses(facid, sessionid) {
    $.ajax({
        url: "ajaxhandler/attendanceAJAX.php",
        type: "POST",
        dataType: "json",
        data: { facid: facid, sessionid: sessionid, action: "getFacultyCourses" },
        success: function (rv) {
            let x = getCourseCardHTML(rv);
            $("#classlistarea").html(x);
        }
    });
}

function getClassdetailsAreaHTML(classobject) {
    let dobj = new Date();
    let year = dobj.getFullYear();
    let month = (dobj.getMonth() + 1).toString().padStart(2, '0');
    let day = dobj.getDate().toString().padStart(2, '0');
    let ondate = `${year}-${month}-${day}`;
    return `<div class="classdetails">
                <div class="code-area">${classobject['code']}</div>
                <div class="title-area">${classobject['title']}</div>
                <div class="ondate-area">
                    <input type="date" value='${ondate}' id='dtpondate'>
                </div>
            </div>`;
}

function getStudentListHTML(studentList) {
    let x = `<div class="studenttlist"><label>STUDENT LIST</label></div>`;
    for (let i = 0; i < studentList.length; i++) {
        let cs = studentList[i];
        let checkedState = cs['isPresent'] === 'YES' ? "checked" : "";
        let rowcolor = cs['isPresent'] === 'YES' ? 'presentcolor' : 'absentcolor';
        x += `<div class="studentdetails ${rowcolor}" id="student${cs['id']}">
                <div class="slno-area">${i + 1}</div>
                <div class="rollno-area">${cs['roll_no']}</div>
                <div class="name-area">${cs['name']}</div>
                <div class="checkbox-area" data-studentid='${cs['id']}'>
                    <input type="checkbox" class="cbpresent" data-studentid='${cs['id']}' ${checkedState}>
                </div>
            </div>`;
    }
    x += `<div class="reportsection">
            <button id="btnReport">REPORT</button>
          </div>
          <div id="divReport"></div>`;
    return x;
}

function fetchStudentList(sessionid, classid, facid, ondate) {
    $.ajax({
        url: "ajaxhandler/attendanceAJAX.php",
        type: "POST",
        dataType: "json",
        data: { facid: facid, ondate: ondate, sessionid: sessionid, classid: classid, action: "getStudentList" },
        success: function (rv) {
            let x = getStudentListHTML(rv);
            $("#studentlistarea").html(x);
        }
    });
}

function saveAttendance(studentid, courseid, facultyid, sessionid, ondate, ispresent) {
    $.ajax({
        url: "ajaxhandler/attendanceAJAX.php",
        type: "POST",
        dataType: "json",
        data: { studentid: studentid, courseid: courseid, facultyid: facultyid, sessionid: sessionid, ondate: ondate, ispresent: ispresent, action: "saveattendance" },
        success: function () {
            let row = $(`#student${studentid}`);
            row.toggleClass('presentcolor absentcolor', ispresent === "YES");
        },
        error: function () {
            alert("OOPS!");
        }
    });
}

function downloadCSV(sessionid, classid, facid) {
    $.ajax({
        url: "ajaxhandler/attendanceAJAX.php",
        type: "POST",
        dataType: "json",
        data: { sessionid: sessionid, classid: classid, facid: facid, action: "downloadReport" },
        success: function (rv) {
            $("#divReport").html(`<object data=${rv['filename']} type="text/html" target="_parent"></object>`);
        },
        error: function () {
            alert("OOPS!");
        }
    });
}

$(function () {
    $(document).on("click", "#btnLogout", function () {
        $.ajax({
            url: "ajaxhandler/logoutAjax.php",
            type: "POST",
            dataType: "json",
            data: { id: 1 },
            success: function () {
                document.location.replace("login.php");
            }
        });
    });

    loadSessions();

    $(document).on("change", "#ddlclass", function () {
        let sessionid = $("#ddlclass").val();
        if (sessionid != -1) {
            let facid = $("#hiddenFacId").val();
            fetchFacultyCourses(facid, sessionid);
        }
    });

    $(document).on("click", ".classcard", function () {
        let classobject = $(this).data('classobject');
        $("#hiddenSelectedCourseID").val(classobject['id']);
        $("#classdetailsarea").html(getClassdetailsAreaHTML(classobject));

        let sessionid = $("#ddlclass").val();
        let classid = classobject['id'];
        let facid = $("#hiddenFacId").val();
        let ondate = $("#dtpondate").val();

        if (sessionid != -1) {
            fetchStudentList(sessionid, classid, facid, ondate);
        }
    });

    $(document).on("click", ".cbpresent", function () {
        let ispresent = this.checked ? "YES" : "NO";
        let studentid = $(this).data('studentid');
        let courseid = $("#hiddenSelectedCourseID").val();
        let facultyid = $("#hiddenFacId").val();
        let sessionid = $("#ddlclass").val();
        let ondate = $("#dtpondate").val();
        saveAttendance(studentid, courseid, facultyid, sessionid, ondate, ispresent);
    });

    $(document).on("change", "#dtpondate", function () {
        let sessionid = $("#ddlclass").val();
        let classid = $("#hiddenSelectedCourseID").val();
        let facid = $("#hiddenFacId").val();
        let ondate = $("#dtpondate").val();

        if (sessionid != -1) {
            fetchStudentList(sessionid, classid, facid, ondate);
        }
    });

    $(document).on("click", "#btnReport", function () {
        let sessionid = $("#ddlclass").val();
        let classid = $("#hiddenSelectedCourseID"));
    }
);
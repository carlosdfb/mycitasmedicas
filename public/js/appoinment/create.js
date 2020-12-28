
let $doctor;
$(function () {
    const $specialty  =  $('#specialty');
    $doctor  =  $('#doctor');
    $specialty.change(() => {
        const specialtyId = $specialty.val();
        const url = `/specialties/${specialtyId}/doctors`
        $.getJSON(url, onDoctorLoaded);
    });
})
function onDoctorLoaded(doctors) {
    let htmlOptions = '';
    if (doctors.length === 0) {
        htmlOptions += `<option value="">No hay doctores para la especialidad seleccionada</option>`;
    } else {
        doctors.forEach(doctors => {
            htmlOptions += `<option value="${doctors.id}">${doctors.name}</option>`;
        });
    }
    $doctor.html(htmlOptions);
}

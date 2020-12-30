let $doctor, $date, $specialty, $hours;
let iRadio;
const noHoursAlert = `<div class="alert alert-danger" role="alert">
                    <strong>Disculpe !</strong>No hay horario disponibles para este medico!
                </div>`;
$(function () {
    $specialty = $('#specialty');
    $date = $('#date');
    $doctor = $('#doctor');
    $hours = $('#hours');
    $specialty.change(() => {
        const specialtyId = $specialty.val();
        const url = `/specialties/${specialtyId}/doctors`
        $.getJSON(url, onDoctorLoaded);
    });
    $doctor.change(loadHours);
    $date.change(loadHours);
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
    loadHours()
}

function loadHours() {
    const selectedDate = $date.val();
    const doctorId = $doctor.val();
    const url = `/schedule/hours?date=${selectedDate}&doctor_id=${doctorId}`
    $.getJSON(url, displayHours);

}

function displayHours(data) {

    if (!data.morning && !data.afternoon) {
        $hours.html(noHoursAlert);
        return;
    }
    let htmlHours = '';
    iRadio = 0;

    if (data.morning) {
        const morning_intervals = data.morning;
        morning_intervals.forEach(interval => {
            htmlHours += getRadioIntervalHtml(interval);

        })
    }

    if (data.afternoon) {
        const afternoon_intervals = data.afternoon;
        afternoon_intervals.forEach(interval => {
            htmlHours += getRadioIntervalHtml(interval);

        })
    }
    $hours.html(htmlHours);

}

function getRadioIntervalHtml(interval) {
    const text = `${interval.start} - ${interval.end}`;
    return `<div class="custom-control custom-radio mb-3">
              <input id="interval${iRadio}"
              name="schedule_time"
              type="radio"
              class="custom-control-input"
              value="${interval.start}">
              <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
            </div>`

}

require('./bootstrap');

require('alpinejs');

import Swal from 'sweetalert2';

window.confirmMute = async function (userId, userName) {
    return await Swal.fire({
        icon: 'warning',
        text: `Do you want to mute ${userName}?`,
        showCancelButton: true,
        confirmButtonText: 'Mute',
        confirmButtonColor: '#e3342f',
    });
}

window.mute = async function (userId, userName) {
    const result = await confirmMute(userId, userName);
    console.info(`Result `, result);
    if (result.isConfirmed) {
        try {
            await axios.post(`users/mute`, {userId});
            await Swal.fire(
                'User muted',
                '',
                'success'
            )
            mutatedIds.push(userId);
            document.location.reload();
        } catch (e) {
            console.error(e)
            Swal.fire(
                'Error',
                e.message,
                'error'
            )
        }

    }
};

window.unmute = async function () {
    // var e = document.getElementById("unmuteIds");
    const userIds = Array.from(document.getElementById("unmuteIds").querySelectorAll("option:checked"),e=>Number.parseInt(e.value));
    if (!userIds.length) return;
    console.info(`Unmute`, userIds);
        try {
            await axios.post(`users/unmute`, {userIds});
            await Swal.fire(
                'Users unmuted',
                '',
                'success'
            )
            document.location.reload();
        } catch (e) {
            console.error(e)
            Swal.fire(
                'Error',
                e.message,
                'error'
            )
        }
};

const jsonSettings = document.querySelector('[data-settings-selector="mutated"]')
window.mutatedIds = jsonSettings ? JSON.parse(jsonSettings.textContent) : []
console.info(`Mutated `, window.mutatedIds)

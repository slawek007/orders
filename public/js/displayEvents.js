function displayEvents(eventType, eventContent) {
    let eventContainer = document.querySelector('#messageToUser');
    if (eventType == 'success'){
        eventContainer.innerHTML = '<div class="alert alert-success"><ul><li> ' +eventContent+ ' </li></ul><div>';
    }
    if (eventType == 'error'){
        eventContainer.innerHTML = '<div class="alert alert-danger"><ul><li> ' +eventContent+ ' </li></ul><div>';
    }
    if (eventType == 'off'){
        eventContainer.innerHTML = '';
    }
}

import axios from "axios";
import moment from "moment";

// user
const openChat = document.getElementById('openChat');
const chatContent = document.getElementById('chatContent');
const minimizeChat = document.getElementById('minimizeChat');

const messageElement = document.getElementById('messageOutput');
const userMessageInput = document.getElementById('message');
const sendMessageForm = document.getElementById('chatForm');

// admin
const listUserChatAdmin = document.getElementById('listUserChat');
const messageElementAdmin = document.getElementById('messageOutputAdmin');
const userMessageInputAdmin = document.getElementById('messageAdmin');
const sendMessageFormAdmin = document.getElementById('chatFormAdmin');
const searchInput = document.getElementById('searchInput');

let chats = [];
let adminChats = [];
let userId = 0;

if (typeof userIdFE !== 'undefined') {
    userId = userIdFE
}

echoData()
getChatData()
echoUserReadNew()
if (listUserChatAdmin != null) {
    getUserList()
}

if (searchInput != null) {
    searchInput.addEventListener('keyup', function(event) {
        const searchText = event.target.value;
        getUserSearchList(searchText);
    });
}

function echoData() {
    window.Echo.channel('laravelChat' + userId).listen('.chatting', (res) => {
        if (messageElement != null) {
            if (res.idAdmin != null) {
                messageElement.innerHTML +=
                    '<div><div class="d-flex justify-content-between">   <p class="small mb-1">' + res.username + ' (admin)</p>   <p class="small mb-1 text-muted">'+ moment().format('HH:mm DD/MM')  +'</p>  </div>  <div class="d-flex flex-row justify-content-start">      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"         alt="avatar 1" style="width: 45px; height: 100%;">   <div>    <p class="small p-2 ms-3 mb-3 rounded-3" style="background-color: #f5f6f7;">' + res.message + '</p> </div>   </div></div>';
            } else {
                messageElement.innerHTML +=
                    '<div class="d-flex justify-content-between"> <p class="small mb-1 text-muted">'+ moment().format('HH:mm DD/MM')  +'</p> <p class="small mb-1">' + res.username + '</p> </div> <div class="d-flex flex-row justify-content-end mb-4 pt-1"> <div><p class="small p-2 me-3 mb-3 text-white rounded-3 bg-warning">' + res.message + '</p>  </div> <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;"> </div>'
            }
            messageElement.lastElementChild.scrollIntoView({behavior: "smooth"})
        }

        if (messageElementAdmin != null) {
            if (res.idAdmin == null) {
                messageElementAdmin.innerHTML +=
                    '<div class="d-flex flex-row justify-content-start"><img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;"><div> <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">' + res.message + '</p><p class="small ms-3 mb-3 rounded-3 text-muted float-end">'+ moment().format('HH:mm DD/MM')  +'</p> </div></div>'
            } else {
                messageElementAdmin.innerHTML +=
                    '<div class="d-flex flex-row justify-content-end"><div><p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">' + res.message + '</p> <p class="small me-3 mb-3 rounded-3 text-muted">'+ moment().format('HH:mm DD/MM')  +'</p></div> <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;"></div>'
            }
            messageElementAdmin.lastElementChild.scrollIntoView({behavior: "smooth"})
        }
    })
}

function echoUserReadNew() {
    window.Echo.channel('chatRead').listen('.chatReading', (res) => {
        getUserList()
    })
}

if (sendMessageForm != null) {
    sendMessageForm.addEventListener('submit', function (e) {
        e.preventDefault()

        if (userMessageInput.value !== '') {
            axios({
                method: 'post',
                url: '/sendMessage',
                data: {
                    // username: userName,
                    message: userMessageInput.value
                }
            })
        }

        userMessageInput.value = ''
    })
}

function getChatData() {
    axios.get('/listChat')
        .then(response => {
            const data = response.data;
            chats = data;
            displayChatData();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function displayChatData() {
    messageElement.innerHTML = '';
    chats.forEach(chat => {
        if ( chat.admin_id != null) {
            messageElement.innerHTML +=
                '<div><div class="d-flex justify-content-between">   <p class="small mb-1">' + chat.admin.email + ' (admin)</p>   <p class="small mb-1 text-muted">'+ moment(chat.created_at).format('HH:mm DD/MM')  +'</p>  </div>  <div class="d-flex flex-row justify-content-start">      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"         alt="avatar 1" style="width: 45px; height: 100%;">   <div>    <p class="small p-2 ms-3 mb-3 rounded-3" style="background-color: #f5f6f7;">' + chat.content + '</p> </div>   </div></div>';
        } else {
            messageElement.innerHTML +=
                '<div class="d-flex justify-content-between"> <p class="small mb-1 text-muted">'+ moment(chat.created_at).format('HH:mm DD/MM')  +'</p> <p class="small mb-1">' + chat.user.email + '</p> </div> <div class="d-flex flex-row justify-content-end mb-4 pt-1"> <div><p class="small p-2 me-3 mb-3 text-white rounded-3 bg-warning">' + chat.content + '</p>  </div> <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;"> </div>'
        }
    });

    messageElement.lastElementChild.scrollIntoView({ behavior: "smooth" });
}

if (sendMessageFormAdmin != null) {
    sendMessageFormAdmin.addEventListener('submit', function (e) {
        e.preventDefault()

        if (userMessageInputAdmin.value !== '') {
            axios({
                method: 'post',
                url: '/sendMessageAdmin',
                data: {
                    idUser: userId,
                    message: userMessageInputAdmin.value
                }
            })
        }

        userMessageInputAdmin.value = ''
        searchInput.value = '';
    })
}

function getChatDataAdmin(id) {
    axios.get('/listChatAdmin/'+id)
        .then(response => {
            const data = response.data;
            adminChats = data;
            displayChatDataAdmin();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function displayChatDataAdmin() {
    messageElementAdmin.innerHTML = '';
    adminChats.forEach(chat => {
        if ( chat.admin_id == null) {
            messageElementAdmin.innerHTML +=
                '<div class="d-flex flex-row justify-content-start"><img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;"><div> <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">' + chat.content + '</p><p class="small ms-3 mb-3 rounded-3 text-muted float-end">'+ moment(chat.created_at).format('HH:mm DD/MM')  +'</p> </div></div>'

        } else {
            messageElementAdmin.innerHTML +=
                '<div class="d-flex flex-row justify-content-end"><div><p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">' + chat.content + '</p> <p class="small me-3 mb-3 rounded-3 text-muted">'+ moment(chat.created_at).format('HH:mm DD/MM')  +'</p></div> <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" alt="avatar 1" style="width: 45px; height: 100%;"></div>'
        }
    });

    messageElementAdmin.lastElementChild.scrollIntoView({ behavior: "smooth" });
}

function getUserList() {
    axios.get('admin/chat/getUser')
        .then(response => {
            const data = response.data;
            listUserChatAdmin.innerHTML = '';
            data.forEach(chat => {
                const listItem = document.createElement('li');
                listItem.className = 'btnOpenChat p-2 border-bottom';
                listItem.setAttribute('data-user-id', chat.user_id);

                let timeCheck = ''
                const duration = moment.duration(moment().diff(moment(chat.created_at)));
                if (duration.asMinutes() < 60) {
                    const minutesAgo = Math.floor(duration.asMinutes());
                    timeCheck = minutesAgo+' phút trước'
                } else if (duration.asDays() < 1) {
                    const hoursAgo = Math.floor(duration.asHours());
                    timeCheck = hoursAgo+' giờ trước'
                } else {
                    const daysAgo = Math.floor(duration.asDays());
                    timeCheck = daysAgo+' ngày trước'
                }

                const listItemContent =
                    '<a class="d-flex justify-content-between">\n' +
                    '    <div class="d-flex flex-row">\n' +
                    '        <div>\n' +
                    '            <img\n' +
                    '                src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"\n' +
                    '                alt="avatar" class="d-flex align-self-center me-3" width="60">\n' +
                    '            <span class="badge bg-success badge-dot"></span>\n' +
                    '        </div>\n' +
                    '        <div class="pt-1">\n' +
                    '            <p class="fw-bold mb-0">'+ chat.email +'</p>\n' +
                    '            <p class="small text-muted">'+ chat.content +'</p>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <div class="pt-1">\n' +
                    '        <p class="small text-muted mb-1">'+timeCheck+'</p>\n' +
                    '        <span class="badge bg-danger rounded-pill float-end">'+ (chat.read === null ? 'new' : '') +'</span>\n' +
                    '    </div>\n' +
                    '</a>';

                listItem.innerHTML += listItemContent;
                listItem.addEventListener('click', function() {
                    window.Echo.leave('laravelChat' + userId);
                    window.Echo.channel('laravelChat' + userId).stopListening('.chatting');

                    userId = this.getAttribute('data-user-id');
                    updateRead(chat.id)
                    getUserList()
                    echoData()
                    getChatDataAdmin(userId)
                });

                listUserChatAdmin.appendChild(listItem);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function updateRead(id) {
    axios({
        method: 'put',
        url: 'admin/chat/updateRead',
        data: {
            id: id
        }
    }).catch(error => {
        console.error('Error:', error);
    });
}

function getUserSearchList(searchText) {
    if (searchText === '') {
        getUserList()
        return
    }
    axios.get('admin/chat/getUserSearch?q='+searchText)
        .then(response => {
            const data = response.data;
            listUserChatAdmin.innerHTML = '';
            data.forEach(user => {
                const listItem = document.createElement('li');
                listItem.className = 'btnOpenChat p-2 border-bottom';
                listItem.setAttribute('data-user-id', user.id);

                const listItemContent =
                    '<a class="d-flex justify-content-between">\n' +
                    '    <div class="d-flex flex-row">\n' +
                    '        <div>\n' +
                    '            <img\n' +
                    '                src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"\n' +
                    '                alt="avatar" class="d-flex align-self-center me-3" width="60">\n' +
                    '            <span class="badge bg-success badge-dot"></span>\n' +
                    '        </div>\n' +
                    '        <div class="pt-1">\n' +
                    '            <p class="fw-bold mb-0">'+ user.email +'</p>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '</a>';

                listItem.innerHTML += listItemContent;
                listItem.addEventListener('click', function() {
                    window.Echo.leave('laravelChat' + userId);
                    window.Echo.channel('laravelChat' + userId).stopListening('.chatting');

                    userId = this.getAttribute('data-user-id');
                    echoData()
                    getChatDataAdmin(userId)
                });

                listUserChatAdmin.appendChild(listItem);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

openChat.addEventListener('click', function() {
    chatContent.style.display = 'inline-block'
    openChat.style.display = 'none'
    messageElement.lastElementChild.scrollIntoView({behavior: "smooth"})
});

minimizeChat.addEventListener('click', function() {
    chatContent.style.display = 'none'
    openChat.style.display = 'inline-block'
});

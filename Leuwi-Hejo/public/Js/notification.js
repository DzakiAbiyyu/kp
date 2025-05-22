function loadNotifications() {
  $.getJSON(baseUrl + "/admin/notifications/ajax/get", function (data) {
    const container = $("#notification-container");
    const badge = $(".badge-counter");
    container.empty();

    if (!data.notifications || data.notifications.length === 0) {
      container.html(
        '<div class="text-center small text-muted py-3">Tidak ada notifikasi</div>'
      );
      badge.text("");
      return;
    }

    data.notifications.forEach(function (n) {
      const isUnread = parseInt(n.is_read) === 0;

      const notifHtml = `
<a class="dropdown-item d-flex align-items-center notif-item ${
        isUnread ? "bg-light notif-unread" : ""
      }" 
   href="${n.link ?? "#"}" 
   data-id="${n.notif_id}">
    <div class="mr-3 position-relative">
        <div class="icon-circle bg-${n.type}">
            <i class="${n.icon} text-white "></i>
            ${
              isUnread
                ? `
                <span class="dot position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
            `
                : ""
            }
        </div>
    </div>
    <div>
        <div class="small text-gray-500">${n.created_at}</div>
        <span class="${isUnread ? "fw-bold" : ""}">${n.message}</span>
    </div>
</a>`;
      container.append(notifHtml);
    });

    badge.text(data.unread > 0 ? data.unread : "");
  });
}

$(document).ready(function () {
  loadNotifications();

  $(document).on("click", ".notif-item", function (e) {
    e.preventDefault();
    const id = $(this).data("id");
    const link = $(this).attr("href");

    $.post(
      baseUrl + "/admin/notifications/mark-read",
      {
        id: id,
      },
      function (response) {
        if (response.success) {
          window.location.href = link;
        } else {
          alert("Gagal membuka notifikasi");
        }
      }
    );
  });
});

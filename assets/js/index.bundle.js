document.addEventListener("DOMContentLoaded", function () {
	const form = document.getElementById("globalOrderForm");
	const tabs = document.querySelectorAll(".tab-button");
	const contents = document.querySelectorAll(".tab-content");

	tabs.forEach((btn) => {
		btn.addEventListener("click", () => {
			tabs.forEach((b) => b.classList.remove("active"));
			btn.classList.add("active");

			const target = btn.dataset.tab;
			contents.forEach((c) => {
				c.classList.remove("active");
				if (c.id === target) c.classList.add("active");
			});
		});
	});

	form.addEventListener("submit", async function (e) {
		e.preventDefault();

		const formData = new FormData(form);
		try {
			const response = await fetch("order.php", {
				method: "POST",
				body: formData,
			});

			const result = await response.json();
			showPopup(result.message, result.success);
			if (result.success) {
				form.reset();
			}
		} catch (error) {
			showPopup("Ошибка при отправке заявки.", false);
		}
	});

	function showPopup(message, success = true) {
		const existing = document.getElementById("orderSuccessPopup");
		if (existing) existing.remove();

		const popup = document.createElement("div");
		popup.className = "popup-notification";
		popup.id = "orderSuccessPopup";
		popup.style.backgroundColor = success ? "#4BB543" : "#D32F2F";
		popup.innerHTML = `
            <span class="popup-close" onclick="this.parentElement.remove()">&times;</span>
            ${message}
        `;

		document.body.appendChild(popup);

		setTimeout(() => {
			popup.style.opacity = "0";
			setTimeout(() => popup.remove(), 500);
		}, 5000);
	}
});

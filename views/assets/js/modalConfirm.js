const ModalConfirm = (() => {
    function crearModal(mensaje, callback = () => { }, confirmText = "Aceptar", cancelText = "Cancelar") {
        const modalExistente = document.getElementById("modalConfirm");
        if (modalExistente) modalExistente.remove();

        const modal = document.createElement("div");
        modal.id = "modalConfirm";
        modal.style.position = "fixed";
        modal.style.top = "0";
        modal.style.left = "0";
        modal.style.width = "100%";
        modal.style.height = "100%";
        modal.style.backgroundColor = "rgba(0,0,0,0.4)";
        modal.style.display = "flex";
        modal.style.justifyContent = "center";
        modal.style.alignItems = "center";
        modal.style.zIndex = "1000";

        modal.innerHTML = `
            <div style="
                background: white;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
                width: 300px;">
                <p>${mensaje}</p>
                <button id="btnConfirm" style="background: #d9534f; color: white; padding: 8px 15px; margin: 5px; border: none; border-radius: 5px;">${confirmText}</button>
                <button id="btnCancel" style="background: #ddd; padding: 8px 15px; margin: 5px; border: none; border-radius: 5px;">${cancelText}</button>
            </div>
        `;

        document.body.appendChild(modal);

        document.getElementById("btnConfirm").addEventListener("click", () => {
            if (typeof callback === "function") callback(); // Verificamos si es una función antes de ejecutarla
            document.body.removeChild(modal);
        });

        document.getElementById("btnCancel").addEventListener("click", () => {
            document.body.removeChild(modal);
        });
    }

    function confirmModal(mensaje, callback = () => { }, confirmText = "Aceptar") {
        const modalExistente = document.getElementById("modalConfirm");
        if (modalExistente) modalExistente.remove();

        const modal = document.createElement("div");
        modal.id = "modalConfirm";
        modal.style.position = "fixed";
        modal.style.top = "0";
        modal.style.left = "0";
        modal.style.width = "100%";
        modal.style.height = "100%";
        modal.style.backgroundColor = "rgba(0,0,0,0.4)";
        modal.style.display = "flex";
        modal.style.justifyContent = "center";
        modal.style.alignItems = "center";
        modal.style.zIndex = "1000";

        modal.innerHTML = `
            <div style="
                background: white;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
                width: 300px;">
                <p>${mensaje}</p>
                <button id="btnConfirm" style="background: #28A745; color: white; padding: 8px 15px; margin: 5px; border: none; border-radius: 5px;">${confirmText}</button>
            </div>
        `;

        document.body.appendChild(modal);

        document.getElementById("btnConfirm").addEventListener("click", () => {
            if (typeof callback === "function") callback(); // Verificamos si es una función antes de ejecutarla
            document.body.removeChild(modal);
        });
    }

    return {
        confirmarConCancelar: crearModal,
        confirmarSoloAceptar: confirmModal
    };
})();

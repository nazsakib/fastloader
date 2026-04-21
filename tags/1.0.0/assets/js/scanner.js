(function ($) {
    'use strict';

    const i18n = typeof sao_fl_i18n !== 'undefined' ? sao_fl_i18n : {
        scanning: 'Smart Asset Optimizer: Scanning DOM for assets...',
        no_assets: 'No WordPress-managed assets detected. Ensure you are on the frontend.',
        active_handles: 'Active Asset Handles',
        scripts: 'Scripts',
        styles: 'Stylesheets',
        tip: 'Tip: Click a handle to copy it to your clipboard.',
        copied: '✓ Copied!',
        error_copy: 'Smart Asset Optimizer: Unable to copy',
        admin_warning: 'Please navigate to the frontend of your website to scan page-specific assets.'
    };

    function showWarningModal(message) {
        const warningHTML = `
            <div id="sao-fl-warning-modal">
                <div class="sao-fl-modal-content sao-fl-warning-content">
                    <div class="sao-fl-modal-header">
                        <h2>Notice</h2>
                        <button class="sao-fl-close-warning-btn sao-fl-close-btn">&times;</button>
                    </div>
                    <div class="sao-fl-modal-body">
                        <p style="font-size: 14px; color: #475569; line-height: 1.5; margin: 0;">${message}</p>
                    </div>
                    <div class="sao-fl-modal-footer" style="text-align: right;">
                        <button class="sao-fl-btn-primary sao-fl-close-warning-btn">Got it</button>
                    </div>
                </div>
            </div>
        `;
        $("#sao-fl-warning-modal").remove();
        $("body").append(warningHTML);
    }

    function scanPage() {
        if ($('body').hasClass('wp-admin')) {
            showWarningModal(i18n.admin_warning);
            return;
        }

        console.log(i18n.scanning);

        let scripts = [];
        let styles = [];

        $("script[id]").each(function () {
            let id = $(this).attr("id");
            if (id.endsWith("-js")) {
                scripts.push(id.replace("-js", ""));
            }
        });

        $("link[id]").each(function () {
            let id = $(this).attr("id");
            if (id.endsWith("-css")) {
                styles.push(id.replace("-css", ""));
            }
        });

        scripts = [...new Set(scripts)].sort();
        styles = [...new Set(styles)].sort();

        if (scripts.length === 0 && styles.length === 0) {
            alert(i18n.no_assets);
            return;
        }

        const modalHTML = `
            <div id="sao-fl-scanner-modal">
                <div class="sao-fl-modal-content">
                    <div class="sao-fl-modal-header">
                        <h2>${i18n.active_handles}</h2>
                        <button class="sao-fl-close-btn">&times;</button>
                    </div>
                    <div class="sao-fl-modal-body">
                        <div class="sao-fl-section-title">
                            ${i18n.scripts} <span class="sao-fl-badge">${scripts.length}</span>
                        </div>
                        <div class="sao-fl-asset-grid">
                            ${scripts.map(s => `<div class="sao-fl-tag" data-handle="${s}">${s}</div>`).join('')}
                        </div>

                        <div class="sao-fl-section-title" style="margin-top: 20px;">
                            ${i18n.styles} <span class="sao-fl-badge">${styles.length}</span>
                        </div>
                        <div class="sao-fl-asset-grid">
                            ${styles.map(s => `<div class="sao-fl-tag" data-handle="${s}">${s}</div>`).join('')}
                        </div>
                    </div>
                    <div class="sao-fl-modal-footer">
                        ${i18n.tip}
                    </div>
                </div>
            </div>
        `;

        $("#sao-fl-scanner-modal").remove();
        $("body").append(modalHTML);
    }

    function closeModal() {
        $("#sao-fl-scanner-modal").fadeOut(200, function () {
            $(this).remove();
        });
    }

    function copyHandle(element) {
        const handle = $(element).data('handle');
        const textArea = document.createElement("textarea");
        textArea.value = handle;
        document.body.appendChild(textArea);
        textArea.select();

        try {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(handle);
            } else {
                document.execCommand('copy');
            }

            const originalText = handle;
            $(element).text(i18n.copied);
            $(element).css({
                "background": "#10b981",
                "color": "#fff",
                "border-color": "#059669"
            });

            setTimeout(() => {
                $(element).text(originalText);
                $(element).css({
                    "background": "",
                    "color": "",
                    "border-color": ""
                });
            }, 1000);

        } catch (err) {
            console.error(i18n.error_copy, err);
        }

        document.body.removeChild(textArea);
    }

    $(document).ready(function () {
        $('#wp-admin-bar-sao-fl-scan-assets a').on('click', function (e) {
            e.preventDefault();
            scanPage();
        });

        $('body').on('click', '.sao-fl-close-btn', function () {
            closeModal();
        });

        $('body').on('click', '.sao-fl-close-warning-btn', function () {
            $("#sao-fl-warning-modal").fadeOut(200, function () {
                $(this).remove();
            });
        });

        $('body').on('click', '.sao-fl-tag', function () {
            copyHandle(this);
        });
    });

    $(document).on('keydown', function (e) {
        if (e.key === "Escape") {
            closeModal();
            $("#sao-fl-warning-modal").fadeOut(200, function () {
                $(this).remove();
            });
        }
    });

})(jQuery);

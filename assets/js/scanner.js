(function ($) {
    'use strict';

    const i18n = typeof fastloader_i18n !== 'undefined' ? fastloader_i18n : {
        scanning: 'FastLoader: Scanning DOM for assets...',
        no_assets: 'No WordPress-managed assets detected. Ensure you are on the frontend.',
        active_handles: 'Active Asset Handles',
        scripts: 'Scripts',
        styles: 'Stylesheets',
        tip: 'Tip: Click a handle to copy it to your clipboard.',
        copied: '✓ Copied!',
        error_copy: 'FastLoader: Unable to copy',
        admin_warning: 'Please navigate to the frontend of your website to scan page-specific assets.'
    };

    function showWarningModal(message) {
        const warningHTML = `
            <div id="fastloader-warning-modal">
                <div class="fastloader-modal-content fastloader-warning-content">
                    <div class="fastloader-modal-header">
                        <h2>Notice</h2>
                        <button class="fastloader-close-warning-btn fastloader-close-btn">&times;</button>
                    </div>
                    <div class="fastloader-modal-body">
                        <p style="font-size: 14px; color: #475569; line-height: 1.5; margin: 0;">${message}</p>
                    </div>
                    <div class="fastloader-modal-footer" style="text-align: right;">
                        <button class="fastloader-btn-primary fastloader-close-warning-btn">Got it</button>
                    </div>
                </div>
            </div>
        `;
        $("#fastloader-warning-modal").remove();
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
            <div id="fastloader-scanner-modal">
                <div class="fastloader-modal-content">
                    <div class="fastloader-modal-header">
                        <h2>${i18n.active_handles}</h2>
                        <button class="fastloader-close-btn">&times;</button>
                    </div>
                    <div class="fastloader-modal-body">
                        <div class="fastloader-section-title">
                            ${i18n.scripts} <span class="fastloader-badge">${scripts.length}</span>
                        </div>
                        <div class="fastloader-asset-grid">
                            ${scripts.map(s => `<div class="fastloader-tag" data-handle="${s}">${s}</div>`).join('')}
                        </div>

                        <div class="fastloader-section-title" style="margin-top: 20px;">
                            ${i18n.styles} <span class="fastloader-badge">${styles.length}</span>
                        </div>
                        <div class="fastloader-asset-grid">
                            ${styles.map(s => `<div class="fastloader-tag" data-handle="${s}">${s}</div>`).join('')}
                        </div>
                    </div>
                    <div class="fastloader-modal-footer">
                        ${i18n.tip}
                    </div>
                </div>
            </div>
        `;

        $("#fastloader-scanner-modal").remove();
        $("body").append(modalHTML);
    }

    function closeModal() {
        $("#fastloader-scanner-modal").fadeOut(200, function () {
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
        $('#wp-admin-bar-fastloader-scan-assets a').on('click', function (e) {
            e.preventDefault();
            scanPage();
        });

        $('body').on('click', '.fastloader-close-btn', function () {
            closeModal();
        });

        $('body').on('click', '.fastloader-close-warning-btn', function () {
            $("#fastloader-warning-modal").fadeOut(200, function () {
                $(this).remove();
            });
        });

        $('body').on('click', '.fastloader-tag', function () {
            copyHandle(this);
        });
    });

    $(document).on('keydown', function (e) {
        if (e.key === "Escape") {
            closeModal();
            $("#fastloader-warning-modal").fadeOut(200, function () {
                $(this).remove();
            });
        }
    });

})(jQuery);

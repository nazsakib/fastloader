function fastloaderScanPage() {
    console.log("FastLoader: Scanning DOM for assets...");

    let scripts = [];
    let styles = [];

    // 1. Find all Script handles
    jQuery("script[id]").each(function () {
        let id = jQuery(this).attr("id");
        if (id.endsWith("-js")) {
            scripts.push(id.replace("-js", ""));
        }
    });

    // 2. Find all Style handles
    jQuery("link[id]").each(function () {
        let id = jQuery(this).attr("id");
        if (id.endsWith("-css")) {
            styles.push(id.replace("-css", ""));
        }
    });

    // Remove duplicates and sort
    scripts = [...new Set(scripts)].sort();
    styles = [...new Set(styles)].sort();

    if (scripts.length === 0 && styles.length === 0) {
        alert("No WordPress-managed assets detected. Ensure you are on the frontend.");
        return;
    }

    // Create and inject the modal
    const modalHTML = `
        <div id="fastloader-scanner-modal">
            <div class="fastloader-modal-content">
                <div class="fastloader-modal-header">
                    <h2>Active Asset Handles</h2>
                    <button class="fastloader-close-btn" onclick="fastloaderCloseModal()">&times;</button>
                </div>
                <div class="fastloader-modal-body">
                    <div class="fastloader-section-title">
                        Scripts <span class="fastloader-badge">${scripts.length}</span>
                    </div>
                    <div class="fastloader-asset-grid">
                        ${scripts.map(s => `<div class="fastloader-tag" onclick="fastloaderCopyHandle(this)">${s}</div>`).join('')}
                    </div>

                    <div class="fastloader-section-title" style="margin-top: 20px;">
                        Stylesheets <span class="fastloader-badge">${styles.length}</span>
                    </div>
                    <div class="fastloader-asset-grid">
                        ${styles.map(s => `<div class="fastloader-tag" onclick="fastloaderCopyHandle(this)">${s}</div>`).join('')}
                    </div>
                </div>
                <div class="fastloader-modal-footer">
                    Tip: Click a handle to copy it to your clipboard.
                </div>
            </div>
        </div>
    `;

    // Remove existing if any
    jQuery("#fastloader-scanner-modal").remove();
    jQuery("body").append(modalHTML);
}

function fastloaderCloseModal() {
    jQuery("#fastloader-scanner-modal").fadeOut(200, function() {
        jQuery(this).remove();
    });
}

/**
 * Enhanced Copy Function
 */
function fastloaderCopyHandle(element) {
    const handle = element.innerText.trim();
    
    // Create a temporary textarea for fallback
    const textArea = document.createElement("textarea");
    textArea.value = handle;
    document.body.appendChild(textArea);
    textArea.select();
    
    try {
        // Try modern API first
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(handle);
        } else {
            // Fallback to execCommand for non-https or older browsers
            document.execCommand('copy');
        }
        
        // Success Visual Feedback
        const originalText = handle;
        element.innerText = "✓ Copied!";
        element.style.background = "#10b981"; // Success Green
        element.style.color = "#fff";
        element.style.borderColor = "#059669";
        
        setTimeout(() => {
            element.innerText = originalText;
            element.style.background = "";
            element.style.color = "";
            element.style.borderColor = "";
        }, 1000);

    } catch (err) {
        console.error('FastLoader: Unable to copy', err);
    }

    document.body.removeChild(textArea);
}

// Close on escape key
jQuery(document).on('keydown', function(e) {
    if (e.key === "Escape") fastloaderCloseModal();
});

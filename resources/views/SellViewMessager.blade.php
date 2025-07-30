<div class="message-conversation">
    <!-- Product Overview -->
    <div class="product-overview-card">
        <div class="product-visual">
            @if($message->product && $message->product->image1)
                <img src="{{ asset('storage/' . $message->product->image1) }}" 
                     class="product-visual-image" 
                     alt="Product Image"
                     onerror="this.src='https://via.placeholder.com/400x300?text=Product+Image'">
            @else
                <div class="product-visual-empty">
                    <i class="bi bi-box-seam"></i>
                </div>
            @endif
        </div>
        <div class="product-details">
            <div class="conversation-meta">
                <span class="conversation-status status-{{ $message->status }}">
                    <i class="bi {{ $message->status === 'unread' ? 'bi-envelope-fill' : 'bi-envelope-open' }}"></i>
                    {{ ucfirst($message->status) }}
                </span>
                <span class="conversation-time">
                    <i class="bi bi-calendar"></i> {{ $message->created_at->format('M d, Y') }}
                </span>
            </div>
            <h2 class="product-name">{{ $message->product->name ?? 'Product Inquiry' }}</h2>
            <div class="product-specs">
                <div class="spec-item">
                    <span class="spec-label"><i class="bi bi-tag"></i> Category</span>
                    <span class="spec-value">{{ $message->product->category ?? 'Not specified' }}</span>
                </div>
                <div class="spec-item">
                    <span class="spec-label"><i class="bi bi-cash-stack"></i> Price</span>
                    <span class="spec-value">${{ number_format($message->product->price ?? 0, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Conversation Thread -->
    <div class="conversation-thread">
        <!-- Buyer's Message -->
        <div class="message-bubble received">
            <div class="message-header">
                <div class="user-avatar">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="user-info">
                    <span class="user-name">{{ $message->buyer_name ?? 'Buyer' }}</span>
                    <span class="user-role">Customer</span>
                </div>
            </div>
            <div class="message-body">
                {{ $message->message }}
            </div>
            <div class="message-footer">
                <span class="timestamp">{{ $message->created_at->format('g:i A') }}</span>
            </div>
        </div>

        <!-- Reply Form -->
        <div class="reply-container">
            <h3 class="reply-title">Your Response</h3>
            <form id="messageReplyForm" class="reply-form" method="POST">
                @csrf
                <div class="form-field">
                    <textarea name="reply_message" placeholder="Write your reply..." rows="5" required></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="send-button">
                        <span>Send Message</span>
                        <i class="bi bi-send-arrow-up"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Description -->
    @if($message->product && $message->product->description)
    <div class="product-full-description">
        <h3 class="description-title">About This Product</h3>
        <div class="description-text">
            {{ $message->product->description }}
        </div>
    </div>
    @endif
</div>

<style>
    .message-conversation {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        max-width: 800px;
        margin: 0 auto;
        color: #2d3748;
    }

    /* Product Overview Card */
    .product-overview-card {
        display: grid;
        grid-template-columns: 160px 1fr;
        gap: 24px;
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 24px;
        border: 1px solid #e2e8f0;
    }

    .product-visual {
        width: 160px;
        height: 160px;
        border-radius: 8px;
        overflow: hidden;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-visual-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-visual-empty {
        color: #cbd5e0;
        font-size: 48px;
    }

    .product-details {
        display: flex;
        flex-direction: column;
    }

    .conversation-meta {
        display: flex;
        gap: 12px;
        margin-bottom: 12px;
    }

    .conversation-status {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-unread {
        background: #fff0f0;
        color: #e53e3e;
    }

    .status-read {
        background: #f0fff4;
        color: #38a169;
    }

    .conversation-time {
        font-size: 13px;
        color: #718096;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .product-name {
        font-size: 20px;
        font-weight: 600;
        margin: 0 0 16px 0;
        color: #1a202c;
    }

    .product-specs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .spec-item {
        display: flex;
        flex-direction: column;
    }

    .spec-label {
        font-size: 13px;
        color: #718096;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .spec-value {
        font-size: 15px;
        font-weight: 500;
        color: #2d3748;
    }

    /* Conversation Thread */
    .conversation-thread {
        background: #ffffff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 24px;
        border: 1px solid #e2e8f0;
    }

    .message-bubble {
        margin-bottom: 24px;
    }

    .message-bubble.received {
        margin-right: 40px;
    }

    .message-header {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #edf2f7;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4a5568;
        margin-right: 12px;
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        font-size: 15px;
    }

    .user-role {
        font-size: 12px;
        color: #718096;
        background: #f8fafc;
        padding: 2px 8px;
        border-radius: 10px;
        align-self: flex-start;
    }

    .message-body {
        background: #f8fafc;
        padding: 16px;
        border-radius: 12px;
        border-top-left-radius: 0;
        line-height: 1.5;
        font-size: 15px;
    }

    .message-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 8px;
    }

    .timestamp {
        font-size: 12px;
        color: #a0aec0;
    }

    /* Reply Form */
    .reply-container {
        margin-top: 32px;
    }

    .reply-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
        color: #2d3748;
    }

    .reply-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .form-field textarea {
        width: 100%;
        padding: 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-family: inherit;
        font-size: 15px;
        resize: vertical;
        min-height: 120px;
        transition: all 0.2s;
    }

    .form-field textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
    }

    .send-button {
        background: #5a67d8;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .send-button:hover {
        background: #4c51bf;
        transform: translateY(-1px);
    }

    /* Product Description */
    .product-full-description {
        background: #ffffff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    .description-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
        color: #2d3748;
    }

    .description-text {
        line-height: 1.6;
        color: #4a5568;
        white-space: pre-wrap;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-overview-card {
            grid-template-columns: 1fr;
        }

        .product-visual {
            width: 100%;
            height: 200px;
        }

        .product-specs {
            grid-template-columns: 1fr;
        }

        .message-bubble.received {
            margin-right: 20px;
        }
    }
</style>

<script>
document.getElementById('messageReplyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const submitButton = form.querySelector('.send-button');
    const originalButtonHTML = submitButton.innerHTML;
    
    // Show loading state
    submitButton.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Sending...';
    submitButton.disabled = true;
    
    // Simulate API call (replace with actual fetch)
    setTimeout(() => {
        // On success
        alert('Your reply has been sent successfully!');
        form.reset();
        submitButton.innerHTML = originalButtonHTML;
        submitButton.disabled = false;
        
        // In a real app, you would add the sent message to the conversation thread
    }, 1500);
});

// Add spinning animation
const style = document.createElement('style');
style.textContent = `
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .spin {
        animation: spin 1s linear infinite;
        display: inline-block;
    }
`;
document.head.appendChild(style);
</script>
hjhghghgh
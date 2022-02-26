// Copied from: https://stackoverflow.com/a/3177838/2014228

export default function timeSince(date) {
    const seconds = Math.floor((new Date() - date) / 1000);

    // Get interval in years
    let interval = seconds / 31536000;
    if (interval > 1) {
        return `${Math.floor(interval)} ${interval < 2 ? "year" : "years"}`;
    }

    // Get interval in months
    interval = seconds / 2592000;
    if (interval > 1) {
        return `${Math.floor(interval)} ${interval < 2 ? "month" : "months"}`;
    }

    // Get interval in days
    interval = seconds / 86400;
    if (interval > 1) {
        return `${Math.floor(interval)} ${interval < 2 ? "day" : "days"}`;
    }

    // Get interval in hours
    interval = seconds / 3600;
    if (interval > 1) {
        return `${Math.floor(interval)} ${interval < 2 ? "hour" : "hours"}`;
    }

    // Get interval in minutes
    interval = seconds / 60;
    if (interval > 1) {
        return `${Math.floor(interval)} ${interval < 2 ? "minute" : "minutes"}`;
    }

    // Get interval in seconds
    return `${Math.floor(seconds)} ${seconds < 2 ? "second" : "seconds"}`;
}

import React from 'react';

const getRelativeTime = (time) => {
    const currentTime = new Date();
    const busTime = new Date(time);
    const diffMs = busTime - currentTime;
    const diffMinutes = Math.round(diffMs / 60000);

    return `${diffMinutes} minutes`;
};

const BusStopDetail = ({ busStop, onClose }) => (
    <div className="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div className="px-6 py-4 bg-white rounded-md shadow-lg">
            <h3 className="text-xl font-semibold">Bus Stop: {busStop.name}</h3>
            {busStop.schedule.length > 0 ? (
                <>
                    <p>Next Bus: {getRelativeTime(busStop.schedule[0].time)}</p>
                    <p>Following Bus: {getRelativeTime(busStop.schedule[1].time)}</p>
                </>
            ) : (
                <p>No more buses today.</p>
            )}
            <button
                onClick={onClose}
                className="mt-4 px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-700"
            >
                Close
            </button>
        </div>
    </div>
);

export default BusStopDetail;

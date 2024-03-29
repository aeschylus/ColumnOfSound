'''
General plan:
    use scikits.audiolab to get data bit by bit
    fft the samples --> get the spectrum
'''
import numpy as np
from collections import deque
from functools import reduce
from scikits.audiolab import Sndfile
from pprint import pprint
import sys

def fft(samples):
    #abs fast fourier transform
    f = np.fft.rfft(samples)
    spectrum = np.abs(f)
    return spectrum

def bandwidth(sample_size, sample_rate):
    #return bandwidth
    return np.multiply(np.true_divide(2, sample_size), np.true_divide(sample_rate, 2))

def frequency_to_index(frequency, sample_size, sample_rate):
    #return index given frequency
    freq = np.float(frequency)
    ss = np.float(sample_size)
    sr = np.float(sample_rate)
    if freq < np.true_divide(bandwidth(ss, sr), 2):
        return 0
    
    if freq > np.true_divide(sr, 2) - np.true_divide(bandwidth(ss, sr), 2):
        return sample_size - 1

    f = np.true_divide(freq, sr)
    i = np.round(np.multiply(ss, f))
    return i

print bandwidth(1024, 44100)
print frequency_to_index(150, 1024, 44100)
sys.exit(0)
#GET THE AUDIO DATA
#
#for future, pass this data to the script
audio_file = "/home/cz/test.ogg"

f = Sndfile(audio_file, "r")

# some germane
# f properties..
    #   samplerate = sample rate of the file
    #   nframes = total number of frames in the file
    #   channels = number of channels in the file
#   methods...
    #   read_frames(number) = read <number> of frames, moves index
    #   seek = go to specific frame

#fourier shit
fouriers_per_second = np.float(1)
#fourier_width = np.float(.3) #in seconds

#the window size for each fft
#fourier_window = fourier_width * f.samplerate
fourier_window = np.float(256)

#frame step between each fft
fourier_step = np.multiply(np.reciprocal(fouriers_per_second), f.samplerate)

#print "samplerate:",f.samplerate
#print "step:",fourier_step
#print "#:", np.true_divide(f.nframes,fourier_step)
#print "window_size:",fourier_window
#print "n frames:",f.nframes
#
one_channel = 1 if f.channels == 1 else 0

i=0
spectrum_data = []
for window in range(int(np.floor_divide(f.nframes, fourier_step))):
    f.seek(i)
    if one_channel:
        chunk = f.read_frames(fourier_window)

    else:

        #average the channels
        chunk = []
        for frame in f.read_frames(fourier_window):
            avg = np.true_divide(np.sum(frame), fourier_window)
            chunk.append(avg)
    
    #fft the samples
    spectrum_data.append(fft(chunk))
    i+=fourier_step

# Now we we have the data, let us average the bands into ~32

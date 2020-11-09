letters = "abcdefghijklmnopqrstuvwxyz "
inverseLetters = {}

numLetters = len(letters)
for i in range(numLetters):
	inverseLetters[letters[i]] = i
	
def encrypt(plain, shift):
    global letters, inverseLetters, numLetters
    cipher = ''
    for i in plain:
        index = (inverseLetters[i] + shift) % numLetters
        cipher += letters[index]
    return cipher
	
def decrypt(plain, shift):
    global letters, inverseLetters, numLetters
    cipher = ''
    for i in plain:
        index = (inverseLetters[i] - shift) % numLetters
        cipher += letters[index]
    return cipher
	
plain = input("enter text: ")
shift = int(input("shift: "))

cipher = encrypt(plain, shift)
decipher = decrypt(plain, shift)

print('cipher: ' + cipher)
print('decipher: ' + decipher)

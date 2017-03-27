from qc5 import *


programa="""
bloch q[4];
x q[2];
z q[3];
? q[0];
id q[0];
sdg q[2];
tdg q[3];
t q[2];
bloch q[1];
measure q[2];
cx q[3], q[0];
y q[0];
h q[0];
"""




qc=QuantumComputer()
qc.reset()
qc.execute(programa)

print ()
print ("========== MAPA DA MEMÓRIA ==========")
print ()

for n in range (0,5):
    arg="q" + str(n)
    print ("Resultado QUBIT",str(n))
    Probability.pretty_print_probabilities (qc.qubits.get_quantum_register_containing(arg).get_state())



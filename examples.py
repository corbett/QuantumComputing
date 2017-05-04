#!/usr/bin/env python3


from QuantumComputer import *
ghz_example_code="""h q[0];
h q[1];
x q[2];
cx q[1], q[2];
cx q[0], q[2];
h q[0];
h q[1];
h q[2];"""
qc=QuantumComputer()
qc.execute(ghz_example_code)
Probability.pretty_print_probabilities(qc.qubits.get_quantum_register_containing("q0").get_state())

swap_example_code="""x q[2];
cx q[1], q[2];
h q[1];
h q[2];
cx q[1], q[2];
h q[1];
h q[2];
cx q[1], q[2];
measure q[1];
measure q[2];"""
qc.reset()
qc.execute(swap_example_code)
Probability.pretty_print_probabilities(qc.qubits.get_quantum_register_containing("q2").get_state())

qc=QuantumComputer()
qc.apply_gate(Gate.X,"q2")
qc.apply_two_qubit_gate_CNOT("q1","q2")
qc.apply_gate(Gate.H,"q1")
qc.apply_gate(Gate.H,"q2")
qc.apply_two_qubit_gate_CNOT("q1","q2")
qc.apply_gate(Gate.H,"q1")
qc.apply_gate(Gate.H,"q2")
qc.apply_two_qubit_gate_CNOT("q1","q2")
qc.measure("q1")
qc.measure("q2")
Probability.pretty_print_probabilities(qc.qubits.get_quantum_register_containing("q1").get_state())

q1=State.zero_state
q2=State.zero_state
q2=Gate.X*q2
new_state=Gate.CNOT2_01*np.kron(q1,q2)
H2_0=np.kron(Gate.H,Gate.eye)
H2_1=np.kron(Gate.eye,Gate.H)
new_state=H2_0*new_state
new_state=H2_1*new_state
new_state=Gate.CNOT2_01*new_state
new_state=H2_0*new_state
new_state=H2_1*new_state
new_state=Gate.CNOT2_01*new_state
Probability.pretty_print_probabilities(new_state)

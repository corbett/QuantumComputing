# QuantumComputing
This is an implementation of IBM's Quantum Experience in simulation; a 5-qubit quantum computer with a limited set of gates.

It also allows you to execute code printed from the Quantum Composer in IBM's syntax.

Check out any of the test functions for example usage. All code on the IBM tutorial is tested for and supported.

Please cite me if you end up using this academically.

# Example usage (with IBM's syntax)
```
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
Probability.pretty_print_probabilities(qc.qubits.get_qubit_named("q0").get_state())
```
This will print
```
|psi>=0.70710678118654724|000>+-0.70710678118654724|111>
Pr(|000>)=0.500000; Pr(|111>)=0.500000; 
```

Or continuing from above
```
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
Probability.pretty_print_probabilities(qc.qubits.get_qubit_named("q2").get_state())
```
will print
```
|psi>=|10>
Pr(|10>)=1.000000; 
```

We'll continue with this example in pure python below.

Note that using IBM's measurment code ```measure q[0];``` will actually collapse the state, but for convenience the internal state before collapse is stored in qubit.get_noop(). Nature doesn't give this to us, but I can can give it to you!


# Pure Python Quantum computing machinery 
Quantum computing operations can also be done in pure python, either with the QuantumComputer machinery or by directly manipulating gates.

```
# Swap Qubits example IBM tutorial Section IV, Page 1
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
Probability.pretty_print_probabilities(qc.qubits.get_qubit_named("q1").get_state())
```
Will print
```
|psi>=|10>
Pr(|10>)=1.000000; 
```

# Working with Individual States and gates

Or by directly working with individual states and gates. Note that states are combined by using the Kronecker product. Gates that operate on entangled states are composed from individual qubit acting gates by the Kronecker product of the gate with the Identity. See the internals of qc.apply_gate or qc.apply_two_qubit_gate_CNOT for general examples, or feel free to use them instead.

```
# Swap Qubits example IBM tutorial Section IV, Page 1 
q1=State.zero_state
q2=State.zero_state
q2=Gate.X*q2
new_state=Gate.CNOT2_01*np.kron(q1,q2)
H2_1=np.kron(Gate.H,Gate.eye)
H2_2=np.kron(Gate.eye,Gate.H)
new_state=H2_1*new_state
new_state=H2_2*new_state
new_state=Gate.CNOT2_01*new_state
new_state=H2_1*new_state
new_state=H2_2*new_state
new_state=Gate.CNOT2_01*new_state
Probability.pretty_print_probabilities(new_state)
```

Will print 
```
|psi>=0.99999999999999967|10>
Pr(|10>)=1.000000;
```

 This manner of working with the library provides the fullest mathematical understanding of what's going on, and any individual state or gate can be printed.
